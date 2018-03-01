
// fix SVGs in IE because the scaling is a real PITA
// https://github.com/owncloud/music/issues/126
if($('html').hasClass('ie')) {
	var replaceSVGs = function() {
		replaceSVG();
		// call them periodically to keep track of possible changes in the artist view
		setTimeout(replaceSVG, 10000);
	};
	replaceSVG();
	setTimeout(replaceSVG, 1000);
	setTimeout(replaceSVGs, 5000);
}

angular.module('Music', ['restangular', 'gettext', 'ngRoute'])
	.config(['RestangularProvider', '$routeProvider',
		function (RestangularProvider, $routeProvider) {

			// configure RESTAngular path
			RestangularProvider.setBaseUrl('api');

			var overviewControllerConfig = {
				controller:'OverviewController',
				templateUrl:'overview.html'
			};

			$routeProvider
				.when('/',				overviewControllerConfig)
				.when('/artist/:id',	overviewControllerConfig)
				.when('/album/:id',		overviewControllerConfig)
				.when('/track/:id',		overviewControllerConfig)
				.when('/file/:id',		overviewControllerConfig);
		}
	])
	.run(function(Token, Restangular){
		// add CSRF token
		Restangular.setDefaultHeaders({requesttoken: Token});
	});

angular.module('Music').controller('MainController',
	['$rootScope', '$scope', '$route', 'ArtistFactory', 'playlistService', 'gettextCatalog', 'Restangular',
	function ($rootScope, $scope, $route, ArtistFactory, playlistService, gettextCatalog, Restangular) {

	// retrieve language from backend - is set in ng-app HTML element
	gettextCatalog.currentLanguage = $rootScope.lang;

	$scope.loading = true;

	// will be invoked by the artist factory
	$rootScope.$on('artistsLoaded', function() {
		$scope.loading = false;
	});

	$scope.currentTrack = null;
	playlistService.subscribe('playing', function(e, track){
		// determine if already inside of an $apply or $digest
		// see http://stackoverflow.com/a/12859093
		if($scope.$$phase) {
			$scope.currentTrack = track;
		} else {
			$scope.$apply(function(){
				$scope.currentTrack = track;
			});
		}
	});

	$scope.anchorArtists = [];

	$scope.letters = [
		'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J',
		'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T',
		'U', 'V', 'W', 'X', 'Y', 'Z'
	];

	$scope.letterAvailable = {};
	for(var i in $scope.letters){
		$scope.letterAvailable[$scope.letters[i]] = false;
	}

	$scope.update = function() {
		$scope.updateAvailable = false;
		$scope.loading = true;
		ArtistFactory.getArtists().then(function(artists){
			$scope.loading = false;
			$scope.artists = artists;
			for(var i=0; i < artists.length; i++) {
				var artist = artists[i],
					letter = artist.name.substr(0,1).toUpperCase();

				if($scope.letterAvailable.hasOwnProperty(letter) === true) {
					if($scope.letterAvailable[letter] === false) {
						$scope.anchorArtists.push(artist.name);
					}
					$scope.letterAvailable[letter] = true;
				}

			}

			$rootScope.$emit('artistsLoaded');
		});
	};

	// initial loading of artists
	$scope.update();

	$scope.processNextScanStep = function(dry) {
		$scope.toScan = false;
		$scope.dryScanRun = dry;

		// if it's not a dry run it will scan
		if(dry === 0) {
			$scope.scanning = true;
		}
		Restangular.all('scan').getList({dry: dry}).then(function(scanItems){
			var scan = scanItems[0];

			// if it was not a dry run and the processed count is bigger than
			// the previous value there are new music files available
			if(scan.processed > $scope.scanningScanned && $scope.dryScanRun === 0) {
				$scope.updateAvailable = true;
			}

			$scope.scanningScanned = scan.processed;
			$scope.scanningTotal = scan.total;

			if(scan.processed < scan.total) {
				// allow recursion but just if it was not a dry run previously
				if($scope.dryScanRun === 0) {
					$scope.processNextScanStep(0);
				} else {
					$scope.toScan = true;
				}
			} else {
				if(scan.processed !== scan.total) {
					Restangular.all('log').post({message: 'Processed more files than available ' + scan.processed + '/' + scan.total });
				}
				$scope.scanning = false;
			}

			if($scope.updateAvailable && $scope.artists.length === 0) {
				$scope.update();
			}
		});
	};

	// initial lookup if new files are available
	$scope.processNextScanStep(1);

	$scope.scanning = false;
	$scope.scanningScanned = 0;
	$scope.scanningTotal = 0;

}]);

angular.module('Music').controller('OverviewController',
	['$scope', '$rootScope', 'playlistService', 'Restangular',
	function ($scope, $rootScope, playlistService, Restangular) {

		$scope.playTrack = function(track) {
			// update URL hash
			window.location.hash = '#/track/' + track.id;

			var artist = _.find($scope.$parent.artists,
				function(artist) {
					return artist.id === track.artistId;
				}),
				album = _.find(artist.albums,
				function(album) {
					return album.id === track.albumId;
				}),
				tracks = _.sortBy(album.tracks,
					function(track) {
						return track.number;
					}
				);
			// determine index of clicked track
			var index = -1;
			for (var i = 0; i < tracks.length; i++) {
				if(tracks[i].id == track.id) {
					index = i;
					break;
				}
			}

			if(index > 0) {
				// slice array in two parts and interchange them
				var begin = tracks.slice(0, index);
				var end = tracks.slice(index);
				tracks = end.concat(begin);
			}
			playlistService.setPlaylist(tracks);
			playlistService.publish('play');
		};

		$scope.playAlbum = function(album) {
			// update URL hash
			window.location.hash = '#/album/' + album.id;

			var tracks = _.sortBy(album.tracks,
					function(track) {
						return track.number;
					}
				);
			playlistService.setPlaylist(tracks);
			playlistService.publish('play');
		};

		$scope.playArtist = function(artist) {
			// update URL hash
			window.location.hash = '#/artist/' + artist.id;

			var albums = _.sortBy(artist.albums,
				function(album) {
					return album.year;
				}),
				playlist = _.union.apply(null,
					_.map(
						albums,
						function(album){
							var tracks = _.sortBy(album.tracks,
								function(track) {
									return track.number;
								}
							);
							return tracks;
						}
					)
				);
			playlistService.setPlaylist(playlist);
			playlistService.publish('play');
		};

		$scope.playFile = function (fileid) {
			if (fileid) {
				Restangular.one('file', fileid).get()
					.then(function(result){
						playlistService.setPlaylist([result]);
						playlistService.publish('play');
					});
			}
		};

		// emited on end of playlist by playerController
		playlistService.subscribe('playlistEnded', function(){
			// update URL hash
			window.location.hash = '#/';
		});

		// variable to count events which needs triggered first to successfully process the request
		$scope.eventsBeforePlaying = 2;

		// will be invoked by the audio factory
		$rootScope.$on('SoundManagerReady', function() {
			if($rootScope.started) {
				// invoke play after the flash gets unblocked
				$scope.$apply(function(){
					playlistService.publish('play');
				});
			}
			if (!--$scope.eventsBeforePlaying) {
				$scope.initializePlayerStateFromURL();
			}
		});

		$rootScope.$on('artistsLoaded', function () {
			if (!--$scope.eventsBeforePlaying) {
				$scope.initializePlayerStateFromURL();
			}
		});

		$scope.initializePlayerStateFromURL = function() {
			var hashParts = window.location.hash.substr(1).split('/');
			if (!hashParts[0] && hashParts[1] && hashParts[2]) {
				type = hashParts[1];
				var id = hashParts[2];

				if (type == 'file') {
					// trigger play
					$scope.playFile(id);
				} else if (type == 'artist') {
					// search for the artist by id
					object = _.find($scope.$parent.artists, function(artist) {
						return artist.id == id;
					});
					// trigger play
					$scope.playArtist(object);
				} else {
					var albums = _.flatten(_.pluck($scope.$parent.artists, 'albums'));
					if (type == 'album') {
						// search for the album by id
						object = _.find(albums, function(album) {
							return album.id == id;
						});
						// trigger play
						$scope.playAlbum(object);
					} else if (type == 'track') {
						var tracks = _.flatten(_.pluck(albums, 'tracks'));
						// search for the track by id
						object = _.find(tracks, function(track) {
							return track.id == id;
						});
						// trigger play
						$scope.playTrack(object);
					}
				}
			}
		};

}]);

angular.module('Music').controller('PlayerController',
	['$scope', '$rootScope', 'playlistService', 'Audio', 'Restangular', 'gettext', 'gettextCatalog', '$timeout',
	function ($scope, $rootScope, playlistService, Audio, Restangular, gettext, gettextCatalog, $timeout) {

	$scope.playing = false;
	$scope.loading = false;
	$scope.player = Audio;
	$scope.currentTrack = null;
	$scope.currentArtist = null;
	$scope.currentAlbum = null;

	$scope.repeat = false;
	$scope.shuffle = false;
	$scope.position = {
		buffer: 0,
		current: 0,
		total: 0
	};

	// display a play icon in the title if a song is playing
	$scope.$watch('playing', function(newValue) {
		var title = $('title').html().trim();
		if(newValue) {
			$('title').html('▶ ' + title);
		} else {
			if(title.substr(0, 1) === '▶') {
				$('title').html(title.substr(1).trim());
			}
		}
	});

	$scope.getPlayableFileURL = function (track) {
		for(var mimeType in track.files) {
			if(mimeType=='audio/flac' || mimeType=='audio/mpeg' || mimeType=='audio/ogg') {
				return {
					'type': mimeType,
					'url': track.files[mimeType]
				};
			}
		}

		return null;
	};

	$scope.$watch('currentTrack', function(newValue, oldValue) {
		playlistService.publish('playing', newValue);
		$scope.player.stop();
		$scope.setPlay(false);
		$scope.setLoading(true);
		if(newValue !== null) {
			// switch initial state
			$rootScope.started = true;
			// find artist
			$scope.currentArtist = _.find($scope.artists,
										function(artist){
											return artist.id === newValue.artistId;
										});
			// find album
			$scope.currentAlbum = _.find($scope.currentArtist.albums,
										function(album){
											return album.id === newValue.albumId;
										});

			$scope.player=Audio.fromURL($scope.getPlayableFileURL($scope.currentTrack));
			$scope.setLoading(true);

			$scope.player.play();

			$scope.setPlay(true);

			$scope.player.on('buffer', function (percent) {
				$scope.setBufferPercentage(parseInt(percent));
				$scope.$digest();
			});
			$scope.player.on('ready', function () {
				$scope.setLoading(false);
				$scope.$digest();
			});
			$scope.player.on('progress', function (currentTime) {
				$scope.setTime(currentTime/1000, $scope.player.duration/1000);
				$scope.$digest();
			});
			$scope.player.on('end', function() {
				$scope.setPlay(false);
				$scope.$digest();
				if($scope.$$phase) {
					$scope.next();
				} else {
					$scope.$apply(function(){
						$scope.next();
					});
				}
			});
			$scope.player.on('duration', function(msecs) {
				$scope.setTime($scope.position.current, $scope.player.duration/1000);
				$scope.$digest();
			});
		} else {
			$scope.currentArtist = null;
			$scope.currentAlbum = null;
			// switch initial state
			$rootScope.started = false;
			playlistService.publish('playlistEnded');
		}
	}, true);

	$scope.setPlay = function(playing) {
		$scope.playing = playing;
	};

	$scope.setLoading = function(loading) {
		$scope.loading = loading;
	};

	$scope.setTime = function(position, duration) {
		$scope.position.current = position;
		$scope.position.total = duration;
	};

	$scope.setBufferPercentage = function(percent) {
		$scope.position.buffer = percent;
	};

	$scope.toggle = function(forcePlay) {
		forcePlay = forcePlay || false;
		if($scope.currentTrack === null) {
			// nothing to do
			return null;
		}
		if(forcePlay) {
			$scope.player.play();
			$scope.setPlay(true);
		} else {
			$scope.player.togglePlayback();
			$scope.playing = !$scope.playing;
		}
	};

	$scope.next = function() {
		var track = playlistService.getNextTrack($scope.repeat, $scope.shuffle),
			tracksSkipped = false;

		// get the next track as long as the current one contains no playable
		// audio mimetype
		while(track !== null && !$scope.getPlayableFileURL(track)) {
			tracksSkipped = true;
			track = playlistService.getNextTrack($scope.repeat, $scope.shuffle);
		}
		if(tracksSkipped === true) {
			OC.Notification.show(gettextCatalog.getString(gettext('Some not playable tracks were skipped.')));
			$timeout(OC.Notification.hide, 10000);
		}
		$scope.currentTrack = track;
	};

	$scope.prev = function() {
		var track = playlistService.getPrevTrack();
		if(track !== null) {
			$scope.currentTrack = track;
		}
	};

	$scope.seek = function($event) {
		var offsetX = $event.offsetX || $event.originalEvent.layerX,
			percentage = offsetX / $event.currentTarget.clientWidth;
		// disable seeking for all format because of some angular error
		//$scope.player.seek(percentage);
	};

	playlistService.subscribe('play', function(){
		// fetch track and start playing
		$scope.next();
	});
}]);

angular.module('Music').controller('PlaylistController',
	['$scope', 'playlists', function ($scope, playlists) {

	$scope.playlists = playlists;

}]);
angular.module('Music').directive('albumart', function() {
	return function(scope, element, attrs, ctrl) {
		var setAlbumart = function() {
			if(attrs.cover) {
				// remove placeholder stuff
				element.html('');
				element.css('background-color', '');
				// add background image
				element.css('filter', "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + attrs.cover + "', sizingMethod='scale')");
				element.css('-ms-filter', "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + attrs.cover + "', sizingMethod='scale')");
				element.css('background-image', 'url(' + attrs.cover + ')');
			} else {
				if(attrs.albumart) {
					// remove background image
					element.css('-ms-filter', '');
					element.css('background-image', '');
					// add placeholder stuff
					element.imageplaceholder(attrs.albumart);
					// remove style of the placeholder to allow mobile styling
					element.css('line-height', '');
					element.css('font-size', '');
				}
			}
		};

		attrs.$observe('albumart', setAlbumart);
		attrs.$observe('cover', setAlbumart);
	};
});

angular.module('Music').directive('resize', ['$window', '$rootScope', function($window, $rootScope) {
	return function(scope, element, attrs, ctrl) {
		var resizeNavigation = function() {
			var height = $window.innerHeight;

			// top and button padding of 5px each
			height = height - 10;
			// remove playerbar height if started
			if(scope.started) {
				height = height - 65;
			}
			// remove header height
			height = height - 45;

			element.css('height', height);

			// Hide or replace every second letter on short screens
			if(height < 300) {
				$(".alphabet-navigation a").removeClass("dotted").addClass("stripped");
			} else if(height < 500) {
				$(".alphabet-navigation a").removeClass("stripped").addClass("dotted");
			} else {
				$(".alphabet-navigation a").removeClass("dotted stripped");
			}

			if(height < 300) {
				element.css('line-height', Math.floor(height/13) + 'px');
			} else {
				element.css('line-height', Math.floor(height/26) + 'px');
			}
		};

		// trigger resize on window resize
		$($window).resize(function() {
			resizeNavigation();
		});

		// trigger resize on player status changes
		$rootScope.$watch('started', function() {
			resizeNavigation();
		});

		resizeNavigation();
	};
}]);

angular.module('Music').directive('scrollTo', ['$window', function($window) {
	return function(scope, element, attrs, ctrl) {
		var scrollToElement = function(id) {
			if(!id) {
				// scroll to top if nothing is provided
				$window.scrollTo(0, 0);
			}

			var el = $window.document.getElementById(id);

			if(el) {
				el.scrollIntoView({behavior: "smooth"});
			}
		};

		element.bind('click', function() {
			scrollToElement(attrs.scrollTo);
		});
	};
}]);
angular.module('Music').factory('ArtistFactory', ['Restangular', '$rootScope', function (Restangular, $rootScope) {
	return {
		getArtists: function() { return Restangular.all('collection').getList(); }
	};
}]);

angular.module('Music').factory('Audio', ['$rootScope', function ($rootScope) {
	$rootScope.$emit('SoundManagerReady');
	return new PlayerWrapper();
}]);

angular.module('Music').factory('playlists', function(){
	return [
		{name: 'test playlist 1', id: 1},
		{name: 'test playlist 2', id: 2},
		{name: 'test playlist 3', id: 3},
		{name: 'test playlist 4', id: 4}
	];
});

angular.module('Music').factory('Token', [function () {
	return document.getElementsByTagName('head')[0].getAttribute('data-requesttoken');
}]);

angular.module('Music').filter('playTime', function() {
	return function(input) {
		var minutes = Math.floor(input/60),
			seconds = Math.floor(input - (minutes * 60));
		return minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
	};
});
angular.module('Music').service('playlistService', ['$rootScope', function($rootScope) {
	var playlist = null;
	var currentTrackId = null;
	var played = [];
	return {
		getCurrentTrack: function() {
			if(currentTrackId !== null && playlist !== null) {
				return playlist[currentTrackId];
			}
			return null;
		},
		getPrevTrack: function() {
			if(played.length > 0) {
				currentTrackId = played.pop();
				return playlist[currentTrackId];
			}
			return null;
		},
		getNextTrack: function(repeat, shuffle) {
			if(playlist === null) {
				return null;
			}
			if(currentTrackId !== null) {
				// add previous track id to the played list
				played.push(currentTrackId);
			}
			if(shuffle === true) {
				if(playlist.length === played.length) {
					if(repeat === true) {
						played = [];
					} else {
						currentTrackId = null;
						return null;
					}
				}
				// generate a list with all integers between 0 and playlist.length
				var all = [];
				for(var i = 0; i < playlist.length; i++) {
					all.push(i);
				}
				// remove the already played track ids
				all = _.difference(all, played);
				// determine a random integer out of this set
				currentTrackId = all[Math.round(Math.random() * (all.length - 1))];
			} else {
				if(currentTrackId === null ||
					currentTrackId === (playlist.length - 1) && repeat === true) {
					currentTrackId = 0;
				} else {
					currentTrackId++;
				}
			}
			// repeat is disabled and the end of the playlist is reached
			// -> abort
			if(currentTrackId >= playlist.length) {
				currentTrackId = null;
				return null;
			}
			return playlist[currentTrackId];
		},
		setPlaylist: function(pl) {
			playlist = pl;
			currentTrackId = null;
			player = [];
		},
        publish: function(name, parameters) {
            $rootScope.$emit(name, parameters);
        },
        subscribe: function(name, listener) {
            $rootScope.$on(name, listener);
        }
	};
}]);

angular.module('Music').run(['gettextCatalog', function (gettextCatalog) {
/* jshint -W100 */
    gettextCatalog.setStrings('ach', {});
    gettextCatalog.setStrings('ady', {});
    gettextCatalog.setStrings('af', {});
    gettextCatalog.setStrings('af_ZA', {});
    gettextCatalog.setStrings('ak', {});
    gettextCatalog.setStrings('am_ET', {});
    gettextCatalog.setStrings('ar', {"Albums":"الألبومات","Artists":"الفنانون","Description":"الوصف","Description (e.g. App name)":"الوصف (مثل اسم التطبيق)","Generate API password":"أنشِئ كلمة سر لواجهة برمجة التطبيقات ( API)","Music":"الموسيقى","Next":"التالي","Pause":"إيقاف","Play":"تشغيل","Previous":"السابق","Repeat":"إعادة","Revoke API password":"إلغاء كلمة سر API","Shuffle":"اختيار عشوائي","Some not playable tracks were skipped.":"جرى تخطى بعض المقاطع غير العاملة","This setting specifies the folder which will be scanned for music.":"ستخصص الإعدادات الملف الذي سُيجرى البحث فيه عن الموسيقى","Tracks":"المقاطع","Unknown album":"ألبوم غير معروف","Unknown artist":"فنان غير معروف","Use this address to browse your music collection from any Ampache compatible player.":"استخدم هذا العنوان في أي مشغل متوافق مع Ampache للبحث عن مجموعتك الموسيقية "});
    gettextCatalog.setStrings('ast', {"Albums":"Álbumes","Artists":"Artistes","Description":"Descripción","Description (e.g. App name)":"Descripción (p.ex, nome de l'aplicación)","Generate API password":"Xenerar contraseña pa la API","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Equí pues xenerar contraseñes pa usales cola API d'Ampache, yá que nun puen almacenase de mou seguru pol diseñu de la API d'Ampache. Pues crear toles contraseñes que quieras y revocales en cualquier momentu.","Invalid path":"Camín inválidu","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Recuerda que la API d'Ampache namái ye un prototipu y ye inestable. Informa de la to esperiencia con esta nueva carauterística nel <a href=\"https://github.com/owncloud/music/issues/60\">informe de fallu</a> correspondiente. Prestábame tener una llista de veceros cola que probala. Gracies.","Music":"Música","Next":"Siguiente","Path to your music collection":"Camín a la to coleición de música","Pause":"Posa","Play":"Reproducir","Previous":"Anterior","Repeat":"Repitir","Revoke API password":"Revocar contraseña pa la API","Shuffle":"Mecer","Some not playable tracks were skipped.":"Nun pudieron reproducise dalgunes canciones.","This setting specifies the folder which will be scanned for music.":"Esta configuración especifica la carpeta na que va escanease la música","Tracks":"Canciones","Unknown album":"Álbum desconocíu","Unknown artist":"Artista desconocíu","Use this address to browse your music collection from any Ampache compatible player.":"Usa esta direición pa esplorar la to coleición de música dende cualquier reproductor compatible con Ampache.","Use your username and following password to connect to this Ampache instance:":"Usa'l to nome d'usuariu y la siguiente contraseña pa coneutate con esta instancia d'Ampache:"});
    gettextCatalog.setStrings('az', {"Albums":"Albomlar","Artists":"Müğənnilər","Description":"Açıqlanma","Description (e.g. App name)":"Açıqlanma(Misal üçün proqram adı)","Generate API password":"APİ şifrəsinin generasiyası","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Ampache APİ-nin istifadə edilməsi üçün burda siz şifrələr generasiya edə bilərsiniz ona görə ki, onlar yalnz təhlükəsiz saxlana bilər. Bu Ampache API-nin öz dizaynıdır. Siz istənilən zaman çoxlu şifrə yarada və onları silə bilərsiniz.","Invalid path":"Yalnış ünvan","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Yadda saxlayın, Ampache API yalnız göstərmək üçündür və stabil deyil. Bu imkanla olan öz praktikanızı <a href=\"https://github.com/owncloud/music/issues/60\">səbəb</a> uyğun unvanla bölüşməkdən çəkinməyin. Həmçinin bunun test edilməsi üçün müştərilər siyahısını istərdim.\nTəşəkkürlər ","Music":"Musiqi","Next":"Növbəti","Path to your music collection":"Sizin musiqi yığmasının ünvanı","Pause":"Ara ver","Play":"Oxu","Previous":"Əvvələ","Repeat":"Təkrar","Revoke API password":"API şifrəsini sil","Shuffle":"Qarışdırmaq","Some not playable tracks were skipped.":"Bəzi oxunulabilməyən musiqilər ötürülüb.","This setting specifies the folder which will be scanned for music.":"Bu quraşdırma qovluğu təyin edir hansı ki, musiqi üçün tədqiq ediləcək.","Tracks":"Musiqi","Unknown album":"Bəlli olmayan albom","Unknown artist":"Bəlli olmayan artist","Use this address to browse your music collection from any Ampache compatible player.":"İstənilən Ampache uyğunluğu olan oxuyucudan sizin musiqi kolleksiyanızı göstərmək üçün, bu ünvandan istifadə edin.","Use your username and following password to connect to this Ampache instance:":"Bu Ampache nusxəsinə qoşulmaq üçün öz istifadəçi adı və şifrənizi istifadə edin."});
    gettextCatalog.setStrings('be', {});
    gettextCatalog.setStrings('bg_BG', {"Albums":"Албуми","Artists":"Изпълнители","Description":"Описание","Description (e.g. App name)":"Описание (пр. име на Приложението)","Generate API password":"Генерирай API парола","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Тук можеш да генерираш пароли, които да използваш с Ampache API, защото те не могат да бъдат съхранени по сигурен начин поради архитектурата на Ampachi API. Можеш да генерираш колко искаш пароли и да ги спираш по всяко време.","Invalid path":"Невалиден път","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Помни, че Ampache API е само предварителна варсия и не е стабилно. Можеш да опишеш своя опит с тази услуга на <a href=\"https://github.com/owncloud/music/issues/60\">следната страница</a>.","Music":"Музика","Next":"Следваща","Path to your music collection":"Пътят към музикалната ти колекция","Pause":"Пауза","Play":"Пусни","Previous":"Предишна","Repeat":"Повтори","Revoke API password":"Премахни API паролата","Shuffle":"Разбъркай","Some not playable tracks were skipped.":"Някои невъзпроизведими песни бяха пропуснати.","This setting specifies the folder which will be scanned for music.":"Тази настройка задава папката, която ще бъде сканирана за музика.","Tracks":"Песни","Unknown album":"Непознат албум","Unknown artist":"Непознат изпълнител","Use this address to browse your music collection from any Ampache compatible player.":"Използвай този адрес, за да разглеждаш музикалната си колекция от всеки съвместим с Ampache музикален плеър.","Use your username and following password to connect to this Ampache instance:":"Използвай своето потребителско име и следната парола за връзка с тази Ampache инсталация:"});
    gettextCatalog.setStrings('bn_BD', {"Albums":"অ্যালবামসমূহ","Artists":"শিল্পীগণ","Description":"বিবরণ","Description (e.g. App name)":"বিবরণ (উদাহরণ: অ্যাপ নাম)","Generate API password":"API কুটশব্দ তৈরী কর","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"এখানে আপনি Ampache API এর জন্য কুটশব্দ তৈরী করতে পারেন কারণ তার ডিজােইনের কারণেই Ampache API কে নিরাপদে সংরক্ষণ করা যায়না। আপনার যত খুশি কুটশব্দ তৈরী করতে পারেন এবং ইচ্ছেমাফিক তাদের বাতিল করতেও পারেন।","Invalid path":"পথটি সঠিক নয়","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"মনে রাখুন যে Ampache API একটি প্রিভিউ মাত্র এবং এটি স্থির কিছু নয়। এতদ্বিষয়ে আপনার অভিজ্ঞতা আমাদের জানাতে <a href=\"https://github.com/owncloud/music/issues/60\">issue</a> ব্যাবহার করুন। এটি পরীক্ষা করার জন্য আমার কিছু ব্যাবহারকারী প্রয়োজন। ধন্যবাদ ","Music":"গানবাজনা","Next":"পরবর্তী","Path to your music collection":"আপনার গানের সংগ্রহের পথ ","Pause":"বিরতি","Play":"বাজাও","Previous":"পূর্ববর্তী","Repeat":"পূনঃসংঘটন","Revoke API password":"API কুটশব্দ বাতিল কর","Shuffle":"এলোমেলো কর","Some not playable tracks were skipped.":"বাজানোর অনুপযোগী কিছু ট্র্যাক এড়িয়ে যাওয়া হয়েছে।","This setting specifies the folder which will be scanned for music.":"এই নিয়ামকটি গান খুজে বের করার জন্য ফোল্ডার নির্ধারণ করে।","Tracks":"ট্র্যাকসমূহ","Unknown album":"অজানা অ্যালবাম","Unknown artist":"অজানা শিল্পী","Use this address to browse your music collection from any Ampache compatible player.":"Ampache compatible player হতে আপনার গানের সংগ্রহ দেখতে এই ঠিকানা ব্যাবহার করুন।","Use your username and following password to connect to this Ampache instance:":"এই  Ampache-টিতে সংযুক্ত হতে আপনার ব্যাবহারকারী নাম ও নীচের কুটশব্দ ব্যাবহার করুন:"});
    gettextCatalog.setStrings('bn_IN', {"Albums":"অ্যালবাম","Artists":"শিল্পী","Description":"বর্ণনা","Description (e.g. App name)":"বর্ণনা (যেমন অ্যাপ নাম)","Generate API password":"এপিআই পাসওয়ার্ড নির্মাণ করা","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"এখানে আপনি আম্পাচে এপিআইের সঙ্গে ব্যবহার করার জন্য পাসওয়ার্ড তৈরি করতে পারেন,কারন তাদের নিরাপদ ভাবে সংরক্ষণ করা যাবে না আম্পাচে এপিআই এর নকশার জন্যে।আপনি যখন ইচ্ছে অনেক পাসওয়ার্ড জেনারেট করতে পারেন এবং যে কোনো সময় তাদের প্রত্যাহার করতে পারেন.","Invalid path":"অবৈধ পথ","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"  মনে রাখবেন যে আম্পাচে এপিআই শুধু একটি প্রাকদর্শন এবং অস্থির।এই বৈশিষ্ট্যের সঙ্গে আপনার অভিজ্ঞতা রিপোর্ট করুন বিনা দ্বিধায় <a href=\"https://github.com/owncloud/music/issues/60\">সংশ্লিষ্ট প্রকাশে</a>।আমি সঙ্গে পরীক্ষা করার জন্য গ্রাহকদের একটি তালিকা চাই।ধন্যবাদ","Music":"সঙ্গীত","Next":"পরবর্তী","Path to your music collection":"আপনার সঙ্গীত সংগ্রহের পথ","Pause":"বিরাম","Play":"প্লে","Previous":"পূর্ববর্তী","Repeat":"পুনরাবৃত্তি","Revoke API password":"এপিআই পাসওয়ার্ড প্রত্যাহার করা","Shuffle":"অদলবদল","Some not playable tracks were skipped.":"কিছু কিছু প্লে করার যোগ্য ট্র্যাক এড়ানো হয়েছে।","This setting specifies the folder which will be scanned for music.":"এই সেটিং ফোল্ডার উল্লেখ করে যেটা সঙ্গীতের জন্য স্ক্যান করা হবে।","Tracks":"সঙ্গীত","Unknown album":"অজানা অ্যালবাম","Unknown artist":"অজানা শিল্পী","Use this address to browse your music collection from any Ampache compatible player.":"কোনো আম্পাচে সামঞ্জস্যপূর্ণ প্লেয়ার থেকে আপনার সঙ্গীত সংগ্রহের এবং ব্রাউজ করার জন্য এই ঠিকানা ব্যবহার করুন।","Use your username and following password to connect to this Ampache instance:":"এই আম্পাচে উদাহরণস্বরূপের সাথে সংযোগ স্থাপন করতে আপনার ব্যবহারকারীর নাম ও নিম্নলিখিত পাসওয়ার্ড ব্যবহার করুন:"});
    gettextCatalog.setStrings('bs', {"Description":"Opis","Next":"Sljedeći","Pause":"Pauza","Play":"Play","Previous":"Prethodno","Repeat":"Ponovi"});
    gettextCatalog.setStrings('ca', {"Albums":"Àlbums","Artists":"Artistes","Description":"Descripció","Description (e.g. App name)":"Descripció (per exemple nom de l'aplicació)","Generate API password":"Genera contrasenya API","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Aquí podeu generar contrasenyes per usar amb l'API d'Ampache,ja que no es poden desar de forma segura degut al diseny de l'API d'Ampache. Podeu generar tantes contrasenyes com volgueu i revocar-les en qualsevol moment.","Invalid path":"El camí no és vàlid","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Recordeu que l'API d'Ampache és només una previsualització i que és inestable. Sou lliures d'informar de la vostra experiència amb aquesta característica en el <a href=\"https://github.com/owncloud/music/issues/60\">fil</a> corresponent. També voldríem tenir una llista de clients per fer proves. Gràcies.","Music":"Música","Next":"Següent","Path to your music collection":"Camí a la col·lecció de música","Pause":"Pausa","Play":"Reprodueix","Previous":"Anterior","Repeat":"Repeteix","Revoke API password":"Revoca la cotrasenya de l'API","Shuffle":"Aleatori","Some not playable tracks were skipped.":"Algunes pistes no reproduïbles s'han omès.","This setting specifies the folder which will be scanned for music.":"Aquest arranjament especifica la carpeta que s'escanejarà en cerca de música","Tracks":"Peces","Unknown album":"Àlbum desconegut","Unknown artist":"Artista desconegut","Use this address to browse your music collection from any Ampache compatible player.":"Utilitza aquesta adreça per navegar per la teva col·lecció de música des de qualsevol reproductor compatible amb Ampache.","Use your username and following password to connect to this Ampache instance:":"Useu el vostre nom d'usuari i contrasenya per connectar amb la instància Ampache:"});
    gettextCatalog.setStrings('ca@valencia', {});
    gettextCatalog.setStrings('cs_CZ', {"Albums":"Alba","Artists":"Umělci","Description":"Popis","Description (e.g. App name)":"Popis (např. Jméno aplikace)","Generate API password":"Generovat heslo API","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Zde můžete vytvářet hesla pro Ampache API, protože tato nemohou být uložena skutečně bezpečným způsobem z důvodu designu Ampache API. Je možné vygenerovat libovolné množství hesel a kdykoliv je zneplatnit.","Invalid path":"Chybná cesta","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Mějte na paměti, že Ampache API je stále ve vývoji a není stabilní. Můžete nás bez obav informovat o zkušenostech s touto funkcí odesláním hlášení v příslušném <a href=\"https://github.com/owncloud/music/issues/60\">tiketu</a>. Chtěl bych také sestavit seznam zájemců o testování. Díky","Music":"Hudba","Next":"Následující","Path to your music collection":"Cesta k vaší sbírce hudby","Pause":"Pozastavit","Play":"Přehrát","Previous":"Předchozí","Repeat":"Opakovat","Revoke API password":"Odvolat heslo API","Shuffle":"Promíchat","Some not playable tracks were skipped.":"Některé stopy byly přeskočeny, protože se nedají přehrát.","This setting specifies the folder which will be scanned for music.":"Toto nastavení určuje adresář, ve kterém bude hledána hudba.","Tracks":"Stopy","Unknown album":"Neznámé album","Unknown artist":"Neznámý umělec","Use this address to browse your music collection from any Ampache compatible player.":"Použijte tuto adresu pro přístup k hudební sbírce z jakéhokoliv přehrávače podporujícího Ampache.","Use your username and following password to connect to this Ampache instance:":"Použijte Vaše uživatelské jméno a následující heslo pro připojení k této instanci Ampache:"});
    gettextCatalog.setStrings('cy_GB', {"Description":"Disgrifiad","Music":"Cerddoriaeth","Next":"Nesaf","Pause":"Seibio","Play":"Chwarae","Previous":"Blaenorol","Repeat":"Ailadrodd"});
    gettextCatalog.setStrings('da', {"Albums":"Album","Artists":"Kunstnere","Description":"Beskrivelse","Description (e.g. App name)":"Beskrivelse (f.eks. App-navn)","Generate API password":"Generér API-adgangskode","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Her kan du generere adgangskoder, der bruges med Ampache API'et, da de ikke kan lagres på en rigtig sikker måde, hvilket skyldes designet af Ampache API'et. Du kan generere alle de adgangskoder som du ønsker, og tilbagekalde dem til enhver tid.","Invalid path":"Ugyldig sti","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Det bør holdes for øje, at Ampache API'et er i et meget tidligt stadie og fungerer ustabilt. Du er velkommen til at berette om dine erfaringer med denne funktion i den respektive <a href=\"https://github.com/owncloud/music/issues/60\">sag</a>. Jeg vil også være interesseret i at etablere en kreds af klienter, der kan hjælpe med afprøvninger. Tak","Music":"Musik","Next":"Næste","Path to your music collection":"Sti til dit musikbibliotek ","Pause":"Pause","Play":"Afspil","Previous":"Forrige","Repeat":"Gentag","Revoke API password":"Tilbagekald API-adgangskode","Shuffle":"Bland","Some not playable tracks were skipped.":"Numre som ikke kunne afspilles blev sprunget over.","This setting specifies the folder which will be scanned for music.":"Denne indstilling angiver dén mappe, der vil blive skannet for musik.","Tracks":"Numre","Unknown album":"Ukendt album","Unknown artist":"Ukendt artist","Use this address to browse your music collection from any Ampache compatible player.":"Brug denne adresse til at gennemse din musiksamling fra hvilken som helst Ampache-kompatibel afspiller.","Use your username and following password to connect to this Ampache instance:":"Brug dit brugernavn og følgende adgangskode for at tilslutte til denne Ampache-instans:"});
    gettextCatalog.setStrings('de', {"Albums":"Alben","Artists":"Künstler","Description":"Beschreibung","Description (e.g. App name)":"Beschreibung (z.B. Name der Anwendung)","Generate API password":"API Passwort erzeugen","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Hier kannst Du Passwörter zur Benutzung mit der Ampache-API erzeugen, da diese aufgrund des Designs der Ampache-API auf keine wirklich sichere Art und Weise gespeichert werden können. Du kannst soviele Passwörter generieren, wie Du möchtest und diese jederzeit verwerfen.","Invalid path":"Ungültiger Pfad","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Bitte bedenke, dass die Ampache-API derzeit eine Vorschau und instabil ist. Du kannst gerne Deine Erfahrungen mit dieser Funktion im entsprechenden <a href=\"https://github.com/owncloud/music/issues/60\">Fehlerbericht</a> melden. Ich würde ebenfalls eine Liste von Anwendung zu Testzwecken sammeln. Dankeschön","Music":"Musik","Next":"Weiter","Path to your music collection":"Pfad zu Deiner Musiksammlung","Pause":"Anhalten","Play":"Abspielen","Previous":"Zurück","Repeat":"Wiederholen","Revoke API password":"API Passwort verwerfen","Shuffle":"Zufallswiedergabe","Some not playable tracks were skipped.":"Einige nicht abspielbare Titel wurden übersprungen.","This setting specifies the folder which will be scanned for music.":"Diese Einstellung spezifiziert den zu durchsuchenden Musikordner.","Tracks":"Titel","Unknown album":"Unbekanntes Album","Unknown artist":"Unbekannter Künstler","Use this address to browse your music collection from any Ampache compatible player.":"Nutze diese Adresse zum Durchsuchen Deiner Musiksammlung auf einem beliebigen Ampache-kompatiblen Abspieler.","Use your username and following password to connect to this Ampache instance:":"Nutze Deinen Benutzernamen und folgendes Passwort, um zu dieser Ampache-Instanz zu verbinden:"});
    gettextCatalog.setStrings('de_AT', {"Description":"Beschreibung","Music":"Musik","Next":"Nächstes","Pause":"Pause","Play":"Abspielen","Previous":"Vorheriges","Repeat":"Wiederholen","Shuffle":"Zufallswiedergabe","Unknown album":"Unbekanntes Album","Unknown artist":"Unbekannter Künstler"});
    gettextCatalog.setStrings('de_CH', {"Description":"Beschreibung","Music":"Musik","Next":"Weiter","Pause":"Anhalten","Play":"Abspielen","Previous":"Vorheriges","Repeat":"Wiederholen"});
    gettextCatalog.setStrings('de_DE', {"Albums":"Alben","Artists":"Künstler","Description":"Beschreibung","Description (e.g. App name)":"Beschreibung (z.B. Name der Anwendung)","Generate API password":"API-Passwort erzeugen","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Hier können Sie Passwörter zur Benutzung mit der Ampache-API erzeugen, da diese aufgrund des Designs der Ampache-API auf keine wirklich sichere Art und Weise gespeichert werden können. Sie könenn soviele Passwörter generieren, wie Sie möchten und diese jederzeit verwerfen.","Invalid path":"Ungültiger Pfad","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Bitte bedenken Sie, dass die Ampache-API derzeit eine Vorschau und instabil ist. Sie können gerne Ihre Erfahrungen mit dieser Funktion im entsprechenden <a href=\"https://github.com/owncloud/music/issues/60\">Fehlerbericht</a> melden. Ich würde ebenfalls eine Liste von Anwendung zu Testzwecken sammeln. Dankeschön","Music":"Musik","Next":"Weiter","Path to your music collection":"Pfad zu Ihrer Musiksammlung","Pause":"Anhalten","Play":"Abspielen","Previous":"Zurück","Repeat":"Wiederholen","Revoke API password":"API-Passwort verwerfen","Shuffle":"Zufallswiedergabe","Some not playable tracks were skipped.":"Einige nicht abspielbare Titel wurden übersprungen.","This setting specifies the folder which will be scanned for music.":"Diese Einstellung spezifiziert den zu durchsuchenden Musikordner.","Tracks":"Titel","Unknown album":"Unbekanntes Album","Unknown artist":"Unbekannter Künstler","Use this address to browse your music collection from any Ampache compatible player.":"Nutzen Sie diese Adresse zum Durchsuchen Ihrer Musiksammlung auf einem beliebigen Ampache-kompatiblen Abspieler.","Use your username and following password to connect to this Ampache instance:":"Benutzen Sie Ihren Benutzernamen und folgendes Passwort, um sich mit dieser Ampache-Instanz zu verbinden:"});
    gettextCatalog.setStrings('el', {"Albums":"Άλμπουμ","Artists":"Καλλιτέχνες","Description":"Περιγραφή","Description (e.g. App name)":"Περιγραφή (π.χ. όνομα Εφαρμογής)","Generate API password":"Δημιουργία κωδικού πρόσβασης API","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Εδώ μπορείτε να δημιουργήσετε κωδικούς πρόσβασης για χρήση με το API του Ampache, γιατί δεν είναι δυνατό να αποθηκευτούν με πραγματικά ασφαλή τρόπο λόγω της σχεδίασης του API του Ampache. Μπορείτε να δημιουργήσετε όσα συνθηματικά θέλετε και να τα ανακαλέσετε οποτεδήποτε.","Invalid path":"Άκυρη διαδρομή","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Θυμηθείτε ότι το API του Ampache είναι απλά μια προτεπισκόπηση και είναι ασταθές. Παρακαλούμε αναφέρετε την εμπειρία σας με αυτή τη λειτουργία στην αντίστοιχη <a href=\"https://github.com/owncloud/music/issues/60\">αναφορά</a>. Θα ήταν καλό να υπάρχει επίσης μια λίστα με εφαρμογές προς δοκιμή. Ευχαριστούμε!","Music":"Μουσική","Next":"Επόμενο","Path to your music collection":"Διαδρομή για τη μουσική σας συλλογή","Pause":"Παύση","Play":"Αναπαραγωγή","Previous":"Προηγούμενο","Repeat":"Επανάληψη","Revoke API password":"Ανάκληση κωδικού πρόσβασης API","Shuffle":"Τυχαία αναπαραγωγή","Some not playable tracks were skipped.":"Μερικά μη αναγνώσιμα τραγούδια έχουν παρακαμφθεί.","This setting specifies the folder which will be scanned for music.":"Αυτή η ρύθμιση προσδιορίζει το φάκελο που θα σαρωθεί για μουσική.","Tracks":"Κομμάτια","Unknown album":"Άγνωστο άλμπουμ","Unknown artist":"Άγνωστος καλλιτέχνης","Use this address to browse your music collection from any Ampache compatible player.":"Χρησιμοποιήστε αυτή τη διεύθυνση για να περιηγηθείτε στη μουσική σας συλλογή από οποιοδήποτε εφαρμογή αναπαραγωγής συμβατή με το Ampache.","Use your username and following password to connect to this Ampache instance:":"Χρησιμοποιήστε το όνομα χρήστη σας και τον παρακάτω κωδικό πρόσβασης για να συνδεθείτε σε αυτή την εγκατάσταση του Ampache:"});
    gettextCatalog.setStrings('en@pirate', {"Music":"Music","Pause":"Pause"});
    gettextCatalog.setStrings('en_GB', {"Albums":"Albums","Artists":"Artists","Description":"Description","Description (e.g. App name)":"Description (e.g. App name)","Generate API password":"Generate API password","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.","Invalid path":"Invalid path","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks","Music":"Music","Next":"Next","Path to your music collection":"Path to your music collection","Pause":"Pause","Play":"Play","Previous":"Previous","Repeat":"Repeat","Revoke API password":"Revoke API password","Shuffle":"Shuffle","Some not playable tracks were skipped.":"Some unplayable tracks were skipped.","This setting specifies the folder which will be scanned for music.":"This setting specifies the folder which will be scanned for music.","Tracks":"Tracks","Unknown album":"Unknown album","Unknown artist":"Unknown artist","Use this address to browse your music collection from any Ampache compatible player.":"Use this address to browse your music collection from any Ampache compatible player.","Use your username and following password to connect to this Ampache instance:":"Use your username and following password to connect to this Ampache instance:"});
    gettextCatalog.setStrings('en_NZ', {});
    gettextCatalog.setStrings('eo', {"Albums":"Albumoj","Artists":"Artistoj","Description":"Priskribo","Description (e.g. App name)":"Priskribo (ekz.: aplikaĵonomo)","Invalid path":"Nevalida vojo","Music":"Muziko","Next":"Jena","Path to your music collection":"Vojo al via muzikokolekto","Pause":"Paŭzi...","Play":"Ludi","Previous":"Maljena","Repeat":"Ripeti","Shuffle":"Miksi","Unknown album":"Nekonata albumo","Unknown artist":"Nekonata artisto"});
    gettextCatalog.setStrings('es', {"Albums":"Álbumes","Artists":"Artistas","Description":"Descripción","Description (e.g. App name)":"Descripción (p.ej., nombre de la aplicación)","Generate API password":"Generar contraseña para la API","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Aquí se pueden crear contraseñas para usarlas con el API de Ampache. Dado que el diseño del API de Ampache no permite almacenar contraseñas de manera segura, se puden generar tantas contrasenas como sea necesario, así como revocarlas en cualquier momento.","Invalid path":"Ruta inválida","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Recuerde que el API de Ampache solo es un prototipo y es inestable. Puede reportar su experiencia con esta nueva funcionalidad en el <a href=\"https://github.com/owncloud/music/issues/60\">informe de error</a> correspondiente. También quisiera tener una lista de clientes con quienes probarla. Gracias.","Music":"Música","Next":"Siguiente","Path to your music collection":"Ruta a su colección de música","Pause":"Pausa","Play":"Reproducir","Previous":"Anterior","Repeat":"Repetir","Revoke API password":"Revocar contraseña para la API","Shuffle":"Mezclar","Some not playable tracks were skipped.":"No se pudieron reproducir algunas canciones.","This setting specifies the folder which will be scanned for music.":"Esta configuración especifica la carpeta en la cual se escaneará la música","Tracks":"Audios","Unknown album":"Álbum desconocido","Unknown artist":"Artista desconocido","Use this address to browse your music collection from any Ampache compatible player.":"Use esta dirección para explorar su colección de música desde cualquier reproductor compatible con Ampache.","Use your username and following password to connect to this Ampache instance:":"Use su nombre de usuario y la siguiente contraseña para conectarse con esta instancia de Ampache:"});
    gettextCatalog.setStrings('es_AR', {"Albums":"Álbumes","Artists":"Artistas","Description":"Descripción","Description (e.g. App name)":"Descripción (ej. Nombre de la Aplicación)","Generate API password":"Generar contraseña de la API","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Aquí puede generar contraseñas para usar con la API de Ampache, porque no pueden ser guardadas de manera segura por diseño de la API de Ampache. Puede generar tantas contraseñas como quiera y revocarlas todas en cualquier momento.","Invalid path":"Ruta no válida","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Tenga en cuenta que la API de Ampache esta en etapa de prueba y es inestable. Siéntase libre de reportar su experiencia con esta característica en el correspondiente <a href=\"https://github.com/owncloud/music/issues/60\">punto</a>. También me gustaría tener una lista de clientes para probar.  Gracias!.","Music":"Música","Next":"Siguiente","Path to your music collection":"Ruta a tu colección de música.","Pause":"Pausar","Play":"Reproducir","Previous":"Previo","Repeat":"Repetir","Revoke API password":"Revocar contraseña de la API","Shuffle":"Aleatorio","Tracks":"Pistas","Unknown album":"Album desconocido","Unknown artist":"Artista desconocido","Use this address to browse your music collection from any Ampache compatible player.":"Use esta dirección para navegar tu colección de música desde cualquier reproductor compatible con Ampache.","Use your username and following password to connect to this Ampache instance:":"Use su nombre de usuario y la siguiente contraseña para conectar a esta instancia de Ampache:"});
    gettextCatalog.setStrings('es_BO', {});
    gettextCatalog.setStrings('es_CL', {});
    gettextCatalog.setStrings('es_CO', {});
    gettextCatalog.setStrings('es_CR', {});
    gettextCatalog.setStrings('es_EC', {});
    gettextCatalog.setStrings('es_MX', {"Description":"Descripción","Music":"Música","Next":"Siguiente","Pause":"Pausa","Play":"Reproducir","Previous":"Anterior","Repeat":"Repetir","Shuffle":"Mezclar"});
    gettextCatalog.setStrings('es_PE', {});
    gettextCatalog.setStrings('es_PY', {});
    gettextCatalog.setStrings('es_US', {});
    gettextCatalog.setStrings('es_UY', {});
    gettextCatalog.setStrings('et_EE', {"Albums":"Albumid","Artists":"Artistid","Description":"Kirjeldus","Description (e.g. App name)":"Kirjeldus (nt. rakendi nimi)","Generate API password":"Tekita API parool","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Siin sa saad tekitada parooli, mida kasutada Ampache API-ga, kuid neid ei ole võimalik talletada turvalisel moel Ampache API olemuse tõttu. Sa saad genereerida nii palju paroole kui soovid ning tühistada neid igal ajal.","Invalid path":"Vigane tee","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Pea meeles, et Ampache APi ei ole küps ning on ebastabiilne. Anna teada oma kogemustest selle funktsionaalsusega vastavalt <a href=\"https://github.com/owncloud/music/issues/60\">teemaarendusele</a>. Ühtlasi soovin nimistut klientidest, mida testida. Tänan.","Music":"Muusika","Next":"Järgmine","Path to your music collection":"Tee sinu muusikakoguni","Pause":"Paus","Play":"Esita","Previous":"Eelmine","Repeat":"Korda","Revoke API password":"Keeldu API paroolist","Shuffle":"Juhuslik esitus","Some not playable tracks were skipped.":"Mõned mittemängitavad lood jäeti vahele.","This setting specifies the folder which will be scanned for music.":"See seade määrab kausta, kust muusikat otsitakse.","Tracks":"Rajad","Unknown album":"Tundmatu album","Unknown artist":"Tundmatu esitaja","Use this address to browse your music collection from any Ampache compatible player.":"Kasuta seda aadressi sirvimaks oma muusikakogu suvalisest Ampache-ga ühilduvast muusikapleierist.","Use your username and following password to connect to this Ampache instance:":"Kasuta oma kasutajatunnust ja järgmist parooli ühendumaks selle Ampache instantsiga:"});
    gettextCatalog.setStrings('eu', {"Albums":"Diskak","Artists":"Artistak","Description":"Deskribapena","Description (e.g. App name)":"Deskribapena (adb. App izena)","Generate API password":"Sortu API pasahitza","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Hemen Ampache APIrekin erabiltzeko pasahitzak sor ditzazkezu. Hauek ezin dira modu benetan seguru batean gorde Ampache APIren diseinua dela eta, honengatik nahi duzun pashitz aina sor ditzakezu eta nahi duzunean deuseztatu.","Invalid path":"Baliogabeko bidea","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Gogoratu Ampache APIa aurreikuspen bat besterik ez dela eta ez dela egonkorra.  Mesdez emazu aukera honekiko zure esperientziaren berri dagokion <a href=\"https://github.com/owncloud/music/issues/60\">lekuan</a>. Gustatuko litzaidake ere bezero zerrenda bat izatea probak egin ahal izateko. Milesker","Music":"Musika","Next":"Hurrengoa","Path to your music collection":"Musika bildumaren bidea","Pause":"Pausarazi","Play":"Erreproduzitu","Previous":"Aurrekoa","Repeat":"Errepikatu","Revoke API password":"Ezeztatu API pasahitza","Shuffle":"Nahastu","Some not playable tracks were skipped.":"Erreproduzitu ezin ziren pista batzuk saltatu egin dira.","This setting specifies the folder which will be scanned for music.":"Hemen musika bilatuko den karpetak zehazten dira.","Tracks":"Pistak","Unknown album":"Diska ezezaguna","Unknown artist":"Artista ezezaguna","Use this address to browse your music collection from any Ampache compatible player.":"Erabili helbide hau zure musika bilduma Ampacherekin bateragarria den edozein erreproduktorekin arakatzeko.","Use your username and following password to connect to this Ampache instance:":"Erabili zure erabiltzaile izena eta hurrengo pasahitza Ampache honetara konektatzeko:"});
    gettextCatalog.setStrings('eu_ES', {"Description":"Deskripzioa","Music":"Musika","Next":"Aurrera","Pause":"geldi","Play":"jolastu","Previous":"Atzera","Repeat":"Errepikatu"});
    gettextCatalog.setStrings('fa', {"Albums":"آلبوم ها","Artists":"هنرمندان","Description":"توضیحات","Invalid path":"مسیر اشتباه","Music":"موزیک","Next":"بعدی","Pause":"توقف کردن","Play":"پخش کردن","Previous":"قبلی","Repeat":"تکرار","Shuffle":"درهم"});
    gettextCatalog.setStrings('fi', {});
    gettextCatalog.setStrings('fi_FI', {"Albums":"Albumit","Artists":"Esittäjät","Description":"Kuvaus","Description (e.g. App name)":"Kuvaus (esim. sovelluksen nimi)","Generate API password":"Luo API-salasana","Invalid path":"Virheellinen polku","Music":"Musiikki","Next":"Seuraava","Path to your music collection":"Musiikkikokoelman polku","Pause":"Keskeytä","Play":"Toista","Previous":"Edellinen","Repeat":"Kertaa","Revoke API password":"Kumoa API-salasana","Shuffle":"Sekoita","Some not playable tracks were skipped.":"Ohitettiin joitain sellaisia kappaleita, joita ei voi toistaa.","This setting specifies the folder which will be scanned for music.":"Tämä asetus määrittää kansion, josta musiikkia etsitään.","Tracks":"Kappaleet","Unknown album":"Tuntematon albumi","Unknown artist":"Tuntematon esittäjä","Use this address to browse your music collection from any Ampache compatible player.":"Käytä tätä osoitetta selataksesi musiikkikokoelmaasi miltä tahansa Ampache-yhteensopivalta soittimelta.","Use your username and following password to connect to this Ampache instance:":"Käytä käyttäjätunnustasi ja seuraavaa salasanaa yhditäessäsi tähän Ampache-istuntoon:"});
    gettextCatalog.setStrings('fil', {});
    gettextCatalog.setStrings('fr', {"Albums":"Albums","Artists":"Artistes","Description":"Description","Description (e.g. App name)":"Description (ex. nom de l'application)","Generate API password":"Générer un mot de passe de l'API","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Ici, vous pouvez générer des mots de passe à utiliser avec l'API Ampache, parce qu'ils ne peuvent être stockés d'une manière sécurisée en raison de la conception de l'API d'Ampache. Vous pouvez générer autant de mots de passe que vous voulez et vous pouvez les révoquer à tout instant.","Invalid path":"Chemin non valide","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Gardez en mémoire que l'API Ampache est une avant-première et n'est pas encore stable. N'hésitez pas à donner un retour d'expérience de cette fonctionnalité <a href=\"https://github.com/owncloud/music/issues/60\">sur la page dédiée</a>. On aimerait également obtenir une liste des clients avec lesquels tester. Merci.","Music":"Musique","Next":"Suivant","Path to your music collection":"Chemin vers votre collection de musique","Pause":"Pause","Play":"Lire","Previous":"Précédent","Repeat":"Répéter","Revoke API password":"Révoquer le mot de passe de l'API","Shuffle":"Lecture aléatoire","Some not playable tracks were skipped.":"Certaines pistes non jouables ont été ignorées.","This setting specifies the folder which will be scanned for music.":"Ce paramètre spécifie quel dossier sera balayé pour trouver de la musique.","Tracks":"Pistes","Unknown album":"Album inconnu","Unknown artist":"Artiste inconnu","Use this address to browse your music collection from any Ampache compatible player.":"Utilisez cette adresse pour naviguer dans votre collection musicale avec un client compatible Ampache.","Use your username and following password to connect to this Ampache instance:":"Utilisez votre nom d'utilisateur et le mot de passe suivant pour vous connecter à cette instance d'Ampache : "});
    gettextCatalog.setStrings('fr_CA', {});
    gettextCatalog.setStrings('fy_NL', {});
    gettextCatalog.setStrings('gl', {"Albums":"Albumes","Artists":"Interpretes","Description":"Descrición","Description (e.g. App name)":"Descrición (p.ex. o nome da aplicación)","Generate API password":"Xerar o contrasinal da API","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Aquí pode xerar contrasinais para utilizar coa API de Ampache, xa que non poden ser almacenados nunha forma abondo segura por mor do deseño da API de Ampache. Pode xerar tantos contrasinais como queira e revogalos en calquera momento.","Invalid path":"Ruta incorrecta","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Teña presente que a API de Ampache é só unha edición preliminar e é inestábel. Non dubide en informarnos da súa experiencia con esta característica na correspondente páxina de  <a href=\"https://github.com/owncloud/music/issues/60\">problemas</a>. Gustaríanos tamén, ter unha lista de clientes cos que facer probas. Grazas","Music":"Música","Next":"Seguinte","Path to your music collection":"Ruta á súa colección de música","Pause":"Pausa","Play":"Reproducir","Previous":"Anterior","Repeat":"Repetir","Revoke API password":"Revogar o contrasinal da API","Shuffle":"Ao chou","Some not playable tracks were skipped.":"Omitíronse algunhas pistas non reproducíbeis.","This setting specifies the folder which will be scanned for music.":"Este axuste especifica o cartafol que será analizado na busca de música.","Tracks":"Pistas","Unknown album":"Álbum descoñecido","Unknown artist":"Interprete descoñecido","Use this address to browse your music collection from any Ampache compatible player.":"Utilice este enderezo para navegar pola súa colección de música desde calquera reprodutor compatíbel con Ampache.","Use your username and following password to connect to this Ampache instance:":"Utilice o seu nome de usuario e o seguinte contrasinal para conectarse a esta instancia do Ampache:"});
    gettextCatalog.setStrings('gu', {});
    gettextCatalog.setStrings('he', {"Description":"תיאור","Music":"מוזיקה","Next":"הבא","Pause":"השהה","Play":"נגן","Previous":"קודם","Repeat":"חזרה","Shuffle":"ערבב","Unknown album":"אלבום לא ידוע","Unknown artist":"אמן לא ידוע"});
    gettextCatalog.setStrings('hi', {"Albums":"एलबम","Artists":"कलाकारों","Description":"विवरण","Music":"गाना","Next":"अगला"});
    gettextCatalog.setStrings('hi_IN', {});
    gettextCatalog.setStrings('hr', {"Albums":"Albumi","Artists":"Izvođači","Description":"Opis","Description (e.g. App name)":"Opis (primjer: ime aplikacije)","Generate API password":"Generiraj API lozinku","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Ovo je mjesto gdje možete generirati svoju lozinku za Ampache API, iz razloga što ne mogu biti pohranjene sigurno radi dizajna Ampache API -a. Možeš generirati nebrojeno lozinki i povući ih u bilo koje vrijeme.","Invalid path":"Pogrešna putanja","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Imajte na umu, da je Ampache API tek probna verzija i poprilično je nestabilna. Slobodno opišite svoje iskustvo sa ovom značajkom u priradajući <a href=\"https://github.com/owncloud/music/issues/60\">problem</a> . Također, htjeli bi imati listu klijenata za testiranje. Hvala","Music":"Muzika","Next":"Sljedeća","Path to your music collection":"Putanja do tvoje baze muzike","Pause":"Pauza","Play":"Reprodukcija","Previous":"Prethodna","Repeat":"Ponavljanje","Revoke API password":"Povuci API lozinku","Shuffle":"Slučajni izbor","Some not playable tracks were skipped.":"Trake koje se ne mogu reproducirati, preskočene su","This setting specifies the folder which will be scanned for music.":"Ova postavka specificira folder koji će biti pretražen za muziku","Tracks":"Trake","Unknown album":"Nepoznati album","Unknown artist":"Nepoznati izvođač","Use this address to browse your music collection from any Ampache compatible player.":"Upotrijebi ovu adresu kada želiš vidjeti svoju glazbenu kolekciju sa bilo kojeg Ampache kompatibilnog uređaja","Use your username and following password to connect to this Ampache instance:":"upotrijebi svoje korisničko ime i sljedeću lozinku kako bi se spojio na Ampache instancu:"});
    gettextCatalog.setStrings('hu_HU', {"Albums":"Albumok","Artists":"Előadók","Description":"Leírás","Description (e.g. App name)":"Leírás (például az alkalmazás neve)","Generate API password":"API-jelszó előállítása","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Itt hozhat létre jelszavakat, amikkel távolról használhatja az Ampache szolgáltatást. Azért van szükség másik jelszóra, mert az Amapche protokoll miatt a használt jelszó nem tárolható igazán biztonságosan. Bármikor visszavonhatja az Ampache jelszavát és újat hozhat létre (sőt tobbfélét is használhat a különböző eszközeihez).","Invalid path":"Érvénytelen útvonal","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Kérjük vegye figyelembe, hogy az Ampache támogatás még nem tekinthető stabilnak, ez még csak tesztváltozat. <a href=\"https://github.com/owncloud/music/issues/60\">Ezen a webcímen</a> számolhat be a tapasztalatairól. Jó lenne minél több kliensprogrammal tesztelni a szolgáltatást. Köszönöm!","Music":"Zene","Next":"Következő","Path to your music collection":"A zenegyűjtemény útvonala","Pause":"Szünet","Play":"Lejátszás","Previous":"Előző","Repeat":"Ismétlés","Revoke API password":"API-jelszó visszavonása","Shuffle":"Keverés","Some not playable tracks were skipped.":"Néhány szám kimaradt, amit a rendszer nem tud lejátszani.","This setting specifies the folder which will be scanned for music.":"Ez a beállítás határozza meg, hogy melyik mappát figyelje a rendszer, amikor az zenei tartalmakat keresi.","Tracks":"Számok","Unknown album":"Ismeretlen album","Unknown artist":"Ismeretlen előadó","Use this address to browse your music collection from any Ampache compatible player.":"Ezt a címet használva a zenegyűjtemény bármely Ampache-kompatibilis lejátszóval böngészhető.","Use your username and following password to connect to this Ampache instance:":"Használja a felhasználónevét és a következő jelszót, ha csatlakozni kíván ehhez az Ampache kiszolgálóhoz:"});
    gettextCatalog.setStrings('hy', {"Description":"Նկարագրություն"});
    gettextCatalog.setStrings('ia', {"Description":"Description","Music":"Musica","Next":"Proxime","Pause":"Pausa","Play":"Reproducer","Previous":"Previe","Repeat":"Repeter"});
    gettextCatalog.setStrings('id', {"Albums":"Album","Artists":"Pembuat","Description":"Keterangan","Description (e.g. App name)":"Keterangan (cth. nama Aplikasi)","Generate API password":"Hasilkan sandi API","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Disini Anda dapat menghasilkan sandi untuk digunakan dengan Ampache API, karena mereka tidak dapat disimpan dengan cara yang benar-benar aman karena desain Ampache API. Anda dapat menghasilkan banyak sandi yang Anda inginkan dan mencabut mereka kapan saja.","Invalid path":"Jalur lokasi salah.","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Harus diingat, bahwa Ampache API hanya pratinjau dan tidak stabil. Jangan ragu untuk melaporkan pengalaman Anda dengan fitur ini di <a href=\"https://github.com/owncloud/music/issues/60\">masalah yang sesuai</a>. Saya juga ingin memiliki daftar klien untuk menguji dengannya. Terima kasih","Music":"Musik","Next":"Berikutnya","Path to your music collection":"Jalur lokasi koleksi musik Anda","Pause":"Jeda","Play":"Putar","Previous":"Sebelumnya","Repeat":"Ulangi","Revoke API password":"Cabut sandi API","Shuffle":"Acak","Some not playable tracks were skipped.":"Beberapa trek yang tidak diputar akan dilewati.","This setting specifies the folder which will be scanned for music.":"Pengaturan ini menentukan folder yang akan dipindai untuk musik.","Tracks":"Trek","Unknown album":"Album tidak diketahui","Unknown artist":"Pembuat tidak diketahui","Use this address to browse your music collection from any Ampache compatible player.":"Gunakan alamat ini untuk meramban koleksi musik Anda dari pemutar yang kompatibel dengan Ampache.","Use your username and following password to connect to this Ampache instance:":"Gunakan nama pengguna dan sandi berikut untuk terhubung dengan instansi Ampache:"});
    gettextCatalog.setStrings('io', {});
    gettextCatalog.setStrings('is', {"Music":"Tónlist","Next":"Næst","Pause":"Pása","Play":"Spila","Previous":"Fyrra"});
    gettextCatalog.setStrings('it', {"Albums":"Album","Artists":"Artisti","Description":"Descrizione","Description (e.g. App name)":"Descrizione (ad es. Nome applicazione)","Generate API password":"Genera una password API","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Qui puoi generare le password da utilizzare con l'API di Ampache, perché esse non possono essere memorizzate in maniera sicura a causa della forma dell'API di Ampache. Puoi generare tutte le password che vuoi e revocarle quando vuoi.","Invalid path":"Percorso non valido","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Ricorda, l'API di Ampache è solo un'anteprima e non è stabile. Sentiti libero di segnalare la tua esperienza con questa funzionalità nel corrispondente <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. Preferirei inoltre avere un elenco di client da provare. Grazie.","Music":"Musica","Next":"Successivo","Path to your music collection":"Percorso alla tua collezione musicale","Pause":"Pausa","Play":"Riproduci","Previous":"Precedente","Repeat":"Ripeti","Revoke API password":"Revoca la password API","Shuffle":"Mescola","Some not playable tracks were skipped.":"Alcune tracce non riproducibili sono state saltate.","This setting specifies the folder which will be scanned for music.":"Questa impostazione specifica la cartella che sarà analizzata alla ricerca di musica.","Tracks":"Tracce","Unknown album":"Album sconosciuto","Unknown artist":"Artista sconosciuto","Use this address to browse your music collection from any Ampache compatible player.":"Usa questo indirizzo per sfogliare le tue raccolte musicali da qualsiasi lettore compatibile con Ampache.","Use your username and following password to connect to this Ampache instance:":"Utilizza il tuo nome utente e la password per collegarti a questa istanza di Ampache:"});
    gettextCatalog.setStrings('ja_JP', {"Albums":"アルバム","Artists":"アーティスト","Description":"説明","Description (e.g. App name)":"説明 (例えばアプリケーション名)","Generate API password":"APIパスワードの生成","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"ここでは、Ampache APIに使用するパスワードを生成することができます。Ampache API のパスワードを本当に安全な方法では保管することができないからです。いつでも望むままに、いくつものパスワードを生成したり、それらを無効にしたりすることができます。","Invalid path":"無効なパス","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Ampache APIはまだプレビュー版で、まだ不安定ですので、注意してください。この機能について、 <a href=\"https://github.com/owncloud/music/issues/60\">issue</a> への動作結果報告を歓迎します。テスト済クライアントのリストも作成したいと考えていますので、よろしくお願いいたします。","Music":"ミュージック","Next":"次","Path to your music collection":"音楽コレクションのパス","Pause":"一時停止","Play":"再生","Previous":"前","Repeat":"繰り返し","Revoke API password":"API パスワードを無効にする","Shuffle":"シャッフル","Some not playable tracks were skipped.":"いくつかの再生不可能なトラックを飛ばしました。","This setting specifies the folder which will be scanned for music.":"この設定では、音楽ファイルをスキャンするフォルダーを指定します。","Tracks":"トラック","Unknown album":"不明なアルバム","Unknown artist":"不明なアーティスト","Use this address to browse your music collection from any Ampache compatible player.":"あなたの音楽コレクションをAmpache対応プレイヤーから閲覧するには、このアドレスを使用してください。","Use your username and following password to connect to this Ampache instance:":"このAmpacheインスタンスに接続するには、あなたのユーザー名と以下のパスワードを使用してください:"});
    gettextCatalog.setStrings('jv', {"Music":"Gamelan","Next":"Sak bare","Play":"Puter","Previous":"Sak durunge"});
    gettextCatalog.setStrings('ka', {});
    gettextCatalog.setStrings('ka_GE', {"Description":"გვერდის დახასიათება","Music":"მუსიკა","Next":"შემდეგი","Pause":"პაუზა","Play":"დაკვრა","Previous":"წინა","Repeat":"გამეორება"});
    gettextCatalog.setStrings('km', {"Albums":"អាល់ប៊ុម","Artists":"សិល្បករ","Description":"ការ​អធិប្បាយ","Description (e.g. App name)":"ការ​អធិប្បាយ (ឧ. ឈ្មោះ​កម្មវិធី)","Generate API password":"បង្កើត​ពាក្យ​សម្ងាត់ API","Invalid path":"ទីតាំង​មិន​ត្រឹម​ត្រូវ","Music":"តន្ត្រី","Next":"បន្ទាប់","Pause":"ផ្អាក","Play":"លេង","Previous":"មុន","Repeat":"ធ្វើម្ដងទៀត","Shuffle":"បង្អូស","Tracks":"បទ","Unknown album":"អាល់ប៊ុមអត់​ឈ្មោះ","Unknown artist":"សិល្បករអត់​ឈ្មោះ"});
    gettextCatalog.setStrings('kn', {"Next":"ಮುಂದೆ"});
    gettextCatalog.setStrings('ko', {"Albums":"앨범","Artists":"음악가","Description":"설명","Description (e.g. App name)":"설명(예: 앱 이름)","Generate API password":"API 암호 생성","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Ampache API가 설계된 방법 때문에 Ampache API에 사용할 암호를 완전히 안전한 형태로 저장할 수 없습니다. Ampache API에 사용할 암호를 여기에서 생성하십시오. 필요한 만큼 암호를 생성하고 언제든지 취소할 수 있습니다.","Invalid path":"잘못된 경로","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Ampache API는 아직까지 완전하지 않습니다. 이 기능을 사용하면서 느낀 점을 <a href=\"https://github.com/owncloud/music/issues/60\">보고</a>해 주십시오. 테스트할 클라이언트에 대해서 알려 주셔도 좋습니다. 감사합니다.","Music":"음악","Next":"다음","Path to your music collection":"내 음악 모음집 경로","Pause":"일시 정지","Play":"재생","Previous":"이전","Repeat":"반복","Revoke API password":"API 암호 취소","Shuffle":"임의 재생","Some not playable tracks were skipped.":"재생할 수 없는 곡을 건너뛰었습니다.","This setting specifies the folder which will be scanned for music.":"이 설정은 음악을 검색할 폴더를 지정합니다.","Tracks":"곡","Unknown album":"알 수 없는 앨범","Unknown artist":"알 수 없는 음악가","Use this address to browse your music collection from any Ampache compatible player.":"Ampache와 호환되는 음악 재생기에 이 주소를 입력하면 음악 모음집을 들을 수 있습니다.","Use your username and following password to connect to this Ampache instance:":"이 Ampache 인스턴스에 연결하려면 사용자 이름과 다음 암호를 사용하십시오:"});
    gettextCatalog.setStrings('ku_IQ', {"Description":"پێناسه","Music":"مۆسیقا","Next":"دوواتر","Pause":"وه‌ستان","Play":"لێدان","Previous":"پێشووتر"});
    gettextCatalog.setStrings('lb', {"Description":"Beschreiwung","Music":"Musek","Next":"Weider","Pause":"Paus","Play":"Ofspillen","Previous":"Zeréck","Repeat":"Widderhuelen"});
    gettextCatalog.setStrings('lo', {});
    gettextCatalog.setStrings('lt_LT', {"Description":"Aprašymas","Music":"Muzika","Next":"Kitas","Pause":"Pristabdyti","Play":"Groti","Previous":"Ankstesnis","Repeat":"Kartoti","Shuffle":"Maišyti","Unknown album":"Nežinomas albumas","Unknown artist":"Nežinomas atlikėjas"});
    gettextCatalog.setStrings('lv', {"Description":"Apraksts","Music":"Mūzika","Next":"Nākamā","Pause":"Pauzēt","Play":"Atskaņot","Previous":"Iepriekšējā","Repeat":"Atkārtot"});
    gettextCatalog.setStrings('mg', {});
    gettextCatalog.setStrings('mk', {"Albums":"Албуми","Artists":"Артисти","Description":"Опис","Description (e.g. App name)":"Опис (нпр. име на апликацијата)","Generate API password":"Генерирај API лозинка","Invalid path":"Грешна патека","Music":"Музика","Next":"Следно","Path to your music collection":"Патека до вашата музичка колекција","Pause":"Пауза","Play":"Пушти","Previous":"Претходно","Repeat":"Повтори","Revoke API password":"Отповикај ја API лозинката","Shuffle":"Помешај","Some not playable tracks were skipped.":"Некои песни кои не можеа да се пуштат беа прескокнати.","This setting specifies the folder which will be scanned for music.":"Овие поставки го одредуваат фолдерот кој ќе биде прегледан за музика.","Tracks":"Песна","Unknown album":"Непознат албум","Unknown artist":"Непознат артист"});
    gettextCatalog.setStrings('ml', {});
    gettextCatalog.setStrings('ml_IN', {"Music":"സംഗീതം","Next":"അടുത്തത്","Pause":" നിറുത്ത്","Play":"തുടങ്ങുക","Previous":"മുന്‍പത്തേത്"});
    gettextCatalog.setStrings('mn', {"Albums":"Цомог","Artists":"Хамтлаг/Дуучин","Description":"Тайлбар"});
    gettextCatalog.setStrings('mr', {});
    gettextCatalog.setStrings('ms_MY', {"Description":"Keterangan","Music":"Muzik","Next":"Seterus","Pause":"Jeda","Play":"Main","Previous":"Sebelum","Repeat":"Ulang","Shuffle":"Kocok"});
    gettextCatalog.setStrings('mt_MT', {});
    gettextCatalog.setStrings('my_MM', {"Description":"ဖော်ပြချက်"});
    gettextCatalog.setStrings('nb_NO', {"Albums":"Album","Artists":"Artister","Description":"Beskrivelse","Description (e.g. App name)":"Beskrivelse (f.eks. applikasjonsnavn)","Generate API password":"Generer API-passord","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Her kan du generere passord som kan brukes med Ampache API, fordi de ikke kan lagres på en virkelig sikker måte pga. utformingen av Ampache API. Du kan generere så mange passord som du vil og trekke dem tilbake når som helst.","Invalid path":"Individuell sti","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Vær klar over at Ampache API bare er en forhåndsversjon og er ustabil. Rapporter gjerne dine erfaringer med denne funksjonen i den tilhørende <a href=\"https://github.com/owncloud/music/issues/60\">saken</a>. Jeg vil også gjerne ha en liste over klienter som jeg kan teste med. Takk","Music":"Musikk","Next":"Neste","Path to your music collection":"Sti til din musikksamling","Pause":"Pause","Play":"Spill","Previous":"Forrige","Repeat":"Gjenta","Revoke API password":"Tilbakestill API-passord","Shuffle":"Tilfeldig","Some not playable tracks were skipped.":"Noen ikke-spillbare spor ble hoppet over.","This setting specifies the folder which will be scanned for music.":"Denne innstillingen spesifiserer mappen som vil bli skannet for musikk.","Tracks":"Spor","Unknown album":"Ukjent album","Unknown artist":"Ukjent artist","Use this address to browse your music collection from any Ampache compatible player.":"Bruk denne adressen til å bla gjennom din musikksamling fra hvilket som helst Ampache-kompitabelt lag.","Use your username and following password to connect to this Ampache instance:":"Benytt ditt brukernavn og følgende passord for å koble til denne Ampache-forekomsten:"});
    gettextCatalog.setStrings('nds', {});
    gettextCatalog.setStrings('ne', {});
    gettextCatalog.setStrings('nl', {"Albums":"Albums","Artists":"Artiesten","Description":"Beschrijving","Description (e.g. App name)":"Beschrijving (bijv. appnaam)","Generate API password":"Genereren API wachtwoord","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Hier kunt u wachtwoorden genereren voor gebruik met de Ampacht API, omdat ze door het ontwerp van de Ampache API niet op een echt veilige manier kunnen worden bewaard. U kunt zoveel wachtwoorden genereren als u wilt en ze op elk moment weer intrekken.","Invalid path":"Ongeldig pad","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Vergeet niet dat de Ampache API volop in ontwikkeling is en dus instabiel is. Rapporteer gerust uw ervaringen met deze functionaliteit in deze <a href=\"https://github.com/owncloud/music/issues/60\">melding</a>. Ik zou ook graag een lijst met clients hebben om te kunnen testen. Bij voorbaat dank!","Music":"Muziek","Next":"Volgende","Path to your music collection":"Pad naar uw muziekverzameling","Pause":"Pause","Play":"Afspelen","Previous":"Vorige","Repeat":"Herhaling","Revoke API password":"Intrekken API wachtwoord","Shuffle":"Shuffle","Some not playable tracks were skipped.":"Sommige niet af te spelen nummers werden overgeslagen.","This setting specifies the folder which will be scanned for music.":"De instelling bepaalt de map die wordt gescand op muziek.","Tracks":"Nummers","Unknown album":"Onbekend album","Unknown artist":"Onbekende artiest","Use this address to browse your music collection from any Ampache compatible player.":"Gebruik dit adres om door uw muziekverzameling te bladeren vanaf elke Ampache compatibele speler.","Use your username and following password to connect to this Ampache instance:":"Gebruik uw gebruikersnaam en het volgende wachtwoord om te verbinden met deze Ampache installatie:"});
    gettextCatalog.setStrings('nn_NO', {"Description":"Skildring","Music":"Musikk","Next":"Neste","Pause":"Pause","Play":"Spel","Previous":"Førre","Repeat":"Gjenta"});
    gettextCatalog.setStrings('nqo', {});
    gettextCatalog.setStrings('oc', {"Description":"Descripcion","Music":"Musica","Next":"Venent","Pause":"Pausa","Play":"Fai tirar","Previous":"Darrièr","Repeat":"Torna far"});
    gettextCatalog.setStrings('or_IN', {});
    gettextCatalog.setStrings('pa', {"Music":"ਸੰਗੀਤ"});
    gettextCatalog.setStrings('pl', {"Albums":"Albumy","Artists":"Artyści","Description":"Opis","Description (e.g. App name)":"Opis (np. Nazwa aplikacji)","Generate API password":"Wygeneruj hasło API","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Tutaj możesz wygenerować hasła do używania API Ampache, ponieważ nie mogą one być przechowywane w rzeczywiście bezpieczny sposób z powodu architektury API Ampache. Możesz wygenerować tyle haseł ile chcesz i odwołać je w dowolnym momencie.","Invalid path":"niewłaściwa ścieżka","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Miej na uwadze, że API Ampache jest tylko poglądowe i niestabilne. Możesz swobodnie raportować swoje doświadczenia z tą funkcją w odpowiednim <a href=\"https://github.com/owncloud/music/issues/60\">dokumencie</a>. Chciałbym mieć również listę klientów z którymi będę przeprowadzać testy. Dzięki","Music":"Muzyka","Next":"Następny","Path to your music collection":"Ścieżka do Twojej kolekcji muzyki","Pause":"Wstrzymaj","Play":"Odtwarzaj","Previous":"Poprzedni","Repeat":"Powtarzaj","Revoke API password":"Odwołaj hasło API","Shuffle":"Losowo","Some not playable tracks were skipped.":"Niektóre nieodtwarzalne ścieżki zostały pominięte.","This setting specifies the folder which will be scanned for music.":"To ustawienie określa folder, który będzie skanowany pod kątem muzyki.","Tracks":"Utwory","Unknown album":"Nieznany album","Unknown artist":"Nieznany artysta","Use this address to browse your music collection from any Ampache compatible player.":"Użyj tego adresu aby przeglądać swoją kolekcję muzyczną na dowolnym odtwarzaczu kompatybilnym z Ampache.","Use your username and following password to connect to this Ampache instance:":"Użyj nazwy użytkownika i następującego hasła do połączenia do tej instancji Ampache:"});
    gettextCatalog.setStrings('pt_BR', {"Albums":"Albuns","Artists":"Artistas","Description":"Descrição","Description (e.g. App name)":"Descrição (por exemplo, nome do App)","Generate API password":"Gerar senha API","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Aqui você pode gerar senhas para usar com a API Ampache, porque eles não podem ser armazenados de uma forma muito segura devido ao design da API Ampache. Você pode gerar o maior número de senhas que você quiser e revogá-las a qualquer hora.","Invalid path":"Caminho inválido","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Tenha em mente, que a API Ampache é apenas uma pré-visualização e é instável. Sinta-se livre para relatar sua experiência com esse recurso na questão correspondente <a href=\"https://github.com/owncloud/music/issues/60\">assunto</a>. Eu também gostaria de ter uma lista de clientes para testar. obrigado","Music":"Música","Next":"Próxima","Path to your music collection":"Caminho para a sua coleção de músicas","Pause":"Pausa","Play":"Reproduzir","Previous":"Anterior","Repeat":"Repetir","Revoke API password":"Revogar senha API","Shuffle":"Embaralhar","Some not playable tracks were skipped.":"Algumas faixas não reproduzíveis ​​foram ignoradas.","This setting specifies the folder which will be scanned for music.":"Esta configuração especifica a pasta que será escaneada por músicas.","Tracks":"Trilhas","Unknown album":"Album desconhecido","Unknown artist":"Artista desconhecido","Use this address to browse your music collection from any Ampache compatible player.":"Utilize este endereço para navegar por sua coleção de música a partir de qualquer leitor compatível com Ampache.","Use your username and following password to connect to this Ampache instance:":"Use o seu nome de usuário e senha a seguir para se conectar a essa instância Ampache:"});
    gettextCatalog.setStrings('pt_PT', {"Albums":"Álbuns","Artists":"Artistas","Description":"Descrição","Description (e.g. App name)":"Descrição (ex: Nome da App)","Generate API password":"Gerar palavra-passe da API","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Aqui pode gerar palavras-passe para usar com a API do Ampache, porque elas não podem ser realmente guardadas de uma maneira segura devido ao desenho da API do Ampache. Pode gerar quantas palavras-passe quiser e revoga-las em qualquer altura.","Invalid path":"Caminho inválido","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Lembre-se que a API do Ampache é apenas provisória e instável. Esteja à vontade para relatar a sua experiência com esta característica na <a href=\"https://github.com/owncloud/music/issues/60\">questão</a> correspondente. Também gostaria de ter uma lista de clientes para testar. Obrigado","Music":"Musica","Next":"Próxima","Path to your music collection":"Caminho para a sua colecção de música","Pause":"Pausa","Play":"Reproduzir","Previous":"Anterior","Repeat":"Repetir","Revoke API password":"Revogar palavra-passe da API","Shuffle":"Baralhar","Some not playable tracks were skipped.":"Foram ignoradas algumas faixas com problemas","This setting specifies the folder which will be scanned for music.":"Esta definição especifica a pasta onde vai ser rastreada a música.","Tracks":"Faixas","Unknown album":"Álbum desconhecido","Unknown artist":"Artista desconhecido","Use this address to browse your music collection from any Ampache compatible player.":"Utilize este endereço para navegar na sua colecção de música em qualquer leitor compativel com o Ampache.","Use your username and following password to connect to this Ampache instance:":"Utilize o seu nome de utilizador e a seguinte palavra-passe para ligar a esta instancia do Ampache:"});
    gettextCatalog.setStrings('ro', {"Albums":"Albume","Artists":"Artiști","Description":"Descriere","Description (e.g. App name)":"Descriere (ex. Numele aplicației)","Generate API password":"Generează parola API","Invalid path":"Cale invalidă","Music":"Muzică","Next":"Următor","Path to your music collection":"Calea spre colecția cu muzica dvs.","Pause":"Pauză","Play":"Redă","Previous":"Anterior","Repeat":"Repetă","Unknown album":"Album necunoscut","Unknown artist":"Artist necunoscut"});
    gettextCatalog.setStrings('ru', {"Albums":"Альбомы","Artists":"Исполнители","Description":"Описание","Description (e.g. App name)":"Описание (например Название приложения)","Generate API password":"Генерация пароля для API","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Здесь вы можете генерировать пароли для использования API Ampache, так как они не могут быть сохранены действительно безопасным способом из-за особенностей API Ampache. Вы можете создать столько паролей, сколько необходимо, и отказаться от них в любое время.","Invalid path":"Некорректный путь","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Следует помнить, что API Ampache является предварительной и поэтому неустойчивой реализацией. Не стесняйтесь делиться опытом работы с этой функцией в соответствующем <a href=\"https://github.com/owncloud/music/issues/60\">разделе</a>. Я также хотел бы создать список клиентов для тестирования. Спасибо","Music":"Музыка","Next":"Следующий","Path to your music collection":"Путь до вашей музыкальной коллекции","Pause":"Пауза","Play":"Проиграть","Previous":"Предыдущий","Repeat":"Повтор","Revoke API password":"Отозвать пароль для API","Shuffle":"Перемешать","Some not playable tracks were skipped.":"Некоторые не проигрываемые композиции были пропущены.","This setting specifies the folder which will be scanned for music.":"Эта настройка определяет каталог, в котором будет проведено сканирование музыки.","Tracks":"Композиции","Unknown album":"Неизвестный альбом","Unknown artist":"Неизвестный исполнитель","Use this address to browse your music collection from any Ampache compatible player.":"Используйте этот адрес, чтобы просмотреть вашу музыкальную коллекцию с любого плеера совместимого с Ampache.","Use your username and following password to connect to this Ampache instance:":"Используйте свой логин и пароль ниже для подключения к данному экземпляру Ampache:"});
    gettextCatalog.setStrings('ru_RU', {"Delete":"Удалить","Music":"Музыка"});
    gettextCatalog.setStrings('si_LK', {"Description":"විස්තරය","Music":"සංගීතය","Next":"ඊලඟ","Pause":"විරාමය","Play":"ධාවනය","Previous":"පෙර","Repeat":"පුනරාවර්ථන"});
    gettextCatalog.setStrings('sk', {"Description":"Popis","Repeat":"Opakovať"});
    gettextCatalog.setStrings('sk_SK', {"Albums":"Albumy","Artists":"Interpreti","Description":"Popis","Description (e.g. App name)":"Popis (napr. App name)","Generate API password":"Vygenerovanie hesla API","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Tu môžete vytvárať heslá pre Ampache API, pretože tieto nemôžu byť uložené skutočne bezpečným spôsobom z dôvodu dizajnu Ampache API. Je možné vygenerovať ľubovoľné množstvo hesiel a kedykoľvek ich zneplatniť.","Invalid path":"Neplatná cesta","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Myslite na to, že Ampache API je stále vo vývoji a nie je stabilné. Môžete nás informovať o skúsenostiach s touto funkciou odoslaním hlásenia v príslušnom <a href=\"https://github.com/owncloud/music/issues/60\">tikete</a>. Chcel by som tiež zostaviť zoznam záujemcov o testovanie. Vďaka","Music":"Hudba","Next":"Ďalšia","Path to your music collection":"Cesta k vašej hudobnej zbierke","Pause":"Pauza","Play":"Prehrať","Previous":"Predošlá","Repeat":"Opakovať","Revoke API password":"Zneplatniť heslo API","Shuffle":"Zamiešať","Some not playable tracks were skipped.":"Niektoré neprehrateľné skladby boli vynechané.","This setting specifies the folder which will be scanned for music.":"Toto nastavenie určuje priečinok, v ktorom bude vyhľadaná hudba.","Tracks":"Skladby","Unknown album":"Neznámy album","Unknown artist":"Neznámy umelec","Use this address to browse your music collection from any Ampache compatible player.":"Použite túto adresu pre prístup k hudobnej zbierke z akéhokoľvek prehrávača podporujúceho Ampache.","Use your username and following password to connect to this Ampache instance:":"Použite svoje používateľské meno a heslo pre pripojenie k tejto inštancii Ampache:"});
    gettextCatalog.setStrings('sl', {"Albums":"Albumi","Artists":"Izvajalci","Description":"Opis","Description (e.g. App name)":"Opis (na primer ime programa)","Generate API password":"Ustvari geslo API","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"TU je mogoče ustvariti gesla za uporabo z Ampache API, ker jih ni mogoče shraniti na resnično varen način, zaradi programske zasnove Ampache. Dovoljeno je ustvariti poljubno število gesel, do katerih je neomejen dostop.","Invalid path":"Neveljavna pot","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Imejte v mislih, da je Ampache API namenjen le predogledu in ni povsem stabilna programska oprema. Vaših odzivov in izkušenj o uporabi bomo zelo veseli. Objavite jih preko <a href=\"https://github.com/owncloud/music/issues/60\">spletnega obrazca</a>. Priporočljivo je dodati tudi seznam odjemalcev. Za sodelovanje se vam vnaprej najlepše zahvaljujemo.","Music":"Glasba","Next":"Naslednja","Path to your music collection":"Pot do zbirke glasbe","Pause":"Premor","Play":"Predvajaj","Previous":"Predhodna","Repeat":"Ponovi","Revoke API password":"Razveljavi geslo API","Shuffle":"Premešaj","Some not playable tracks were skipped.":"Nekateri posnetki, ki jih ni mogoče predvajati, so bili preskočeni.","This setting specifies the folder which will be scanned for music.":"Nastavitev določa mapo, ki bo preiskana za glasbo.","Tracks":"Sledi","Unknown album":"Neznan album","Unknown artist":"Neznan izvajalec","Use this address to browse your music collection from any Ampache compatible player.":"Uporabite ta naslov za brskanje po zbirki glasbe preko kateregakoli predvajalnika, ki podpira sistem Ampache.","Use your username and following password to connect to this Ampache instance:":"Uporabite uporabniško ime in navedeno geslo za povezavo z Ampache:"});
    gettextCatalog.setStrings('sq', {"Description":"Përshkrimi","Music":"Muzikë","Next":"Mëpasshëm","Pause":"Pauzë","Play":"Luaj","Previous":"Mëparshëm","Repeat":"Përsëritet","Shuffle":"Përziej"});
    gettextCatalog.setStrings('sr', {"Albums":"Албуми","Artists":"Извођачи","Description":"Опис","Description (e.g. App name)":"Опис (нпр. назив апликације)","Generate API password":"Генериши лозинку АПИ-ја","Invalid path":"Неисправна путања","Music":"Музика","Next":"Следећа","Path to your music collection":"Путања до ваше музичке колекције","Pause":"Паузирај","Play":"Пусти","Previous":"Претходна","Repeat":"Понављај","Shuffle":"Измешај","Some not playable tracks were skipped.":"Прескочене су нумере које се не могу пустити.","This setting specifies the folder which will be scanned for music.":"Ова поставка наводи фасциклу у којој ће бити тражена музика.","Tracks":"Нумере","Unknown album":"Непознат албум","Unknown artist":"Непознат извођач","Use this address to browse your music collection from any Ampache compatible player.":"Користи ову адресу за прегледање ваше музичке колекције из било ког Ампаш компатибилног плејера.","Use your username and following password to connect to this Ampache instance:":"Користите ваше корисничко име и следећу лозинку за повезивање на овај Ампаш:"});
    gettextCatalog.setStrings('sr@latin', {"Albums":"Albumi","Artists":"Izvođači","Description":"Opis","Description (e.g. App name)":"Opis (npr. Ime aplikacije)","Generate API password":"Generiši API lozinku","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Ovde možete da generišete lozinke za korišćenje sa Ampache API-jem za to što one ne mogu biti sačuvane na veoma siguran način zbog dizajna Ampache API-ja. Možete da generišete koliko god želite lozinki i da ih opozovete u bilo kom trenutku.","Invalid path":"Neispravna putanja","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Imajte na umu da je Ampache API samo probna verzija i da je nestabilna. Slobodno prijavite Vaša iskustva sa ovom opcijom obraćajući se na odgovarajuću <a href=\"https://github.com/owncloud/music/issues/60\">stavku</a>. Takođe je dobrodošla lista klijenata za testiranje ove opcije. Hvala","Music":"Muzika","Next":"Sledeća","Path to your music collection":"Putanja do Vaše muzičke kolekcije","Pause":"Pauziraj","Play":"Pusti","Previous":"Prethodna","Repeat":"Ponavljaj","Revoke API password":"Opozovi API lozinku","Shuffle":"Nasumično","Some not playable tracks were skipped.":"Neke numere koje nije bilo moguće pustiti su preskočene.","This setting specifies the folder which will be scanned for music.":"Ovo podešavanje određuje direktorijum koji će biti skeniran u potrazi za muzikom.","Tracks":"Numere","Unknown album":"Nepoznati album","Unknown artist":"Nepoznati izvođač","Use this address to browse your music collection from any Ampache compatible player.":"Koristite ovu adresu da pregledate Vašu muzičku kolekciju iz bilo kog Ampache kompatibilnog plejera.","Use your username and following password to connect to this Ampache instance:":"Koristite Vaše korisničko ime i sledeću lozinku da se povežete na ovu Ampache instancu:"});
    gettextCatalog.setStrings('su', {});
    gettextCatalog.setStrings('sv', {"Albums":"Album","Artists":"Artister","Description":"Beskrivning","Description (e.g. App name)":"Beskrivning (ex. App-namn)","Generate API password":"Generera API-lösenord","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Här kan du generera lösenord för användning med Ampaches API, eftersom de inte kan lagras på ett riktigt säkert sätt på grund av Ampachi API:ns design. Du kan generera så många lösenord du vill och upphäva dem när som helst.","Invalid path":"Ogiltig sökväg","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Kom ihåg, att Ampaches API endast är en förhandsvisning och är ostabil. Du är välkommen att rapportera din upplevelse med denna funktionen i motsvarande <a href=\"https://github.com/owncloud/music/issues/60\">problem</a>. Jag skulle också vilja ha en lista över klienter att testa med.\nTack","Music":"Musik","Next":"Nästa","Path to your music collection":"Sökvägen till din musiksamling","Pause":"Paus","Play":"Spela","Previous":"Föregående","Repeat":"Upprepa","Revoke API password":"Upphäv API-lösenord","Shuffle":"Blanda","Some not playable tracks were skipped.":"Några icke spelbara spår hoppades över","This setting specifies the folder which will be scanned for music.":"Denna inställning specificerar vilken mapp som kommer skannas efter musik","Tracks":"Spår","Unknown album":"Okänt album","Unknown artist":"Okänd artist","Use this address to browse your music collection from any Ampache compatible player.":"Använd denna adress för att bläddra igenom din musiksamling från valfri Ampache-kompatibel enhet.","Use your username and following password to connect to this Ampache instance:":"Använd ditt användarnamn och följande lösenord för att ansluta mot denna Ampache instansen:"});
    gettextCatalog.setStrings('sw_KE', {});
    gettextCatalog.setStrings('ta_IN', {});
    gettextCatalog.setStrings('ta_LK', {"Description":"விவரிப்பு","Music":"இசை","Next":"அடுத்த","Pause":"இடைநிறுத்துக","Play":"Play","Previous":"முன்தைய","Repeat":"மீண்டும்"});
    gettextCatalog.setStrings('te', {"Music":"సంగీతం","Next":"తదుపరి","Previous":"గత"});
    gettextCatalog.setStrings('tg_TJ', {});
    gettextCatalog.setStrings('th_TH', {"Description":"คำอธิบาย","Music":"เพลง","Next":"ถัดไป","Pause":"หยุดชั่วคราว","Play":"เล่น","Previous":"ก่อนหน้า","Repeat":"ทำซ้ำ"});
    gettextCatalog.setStrings('tl_PH', {});
    gettextCatalog.setStrings('tr', {"Albums":"Albümler","Artists":"Sanatçılar","Description":"Açıklama","Description (e.g. App name)":"Açıklama (örn. Uygulama adı)","Generate API password":"API parolası oluştur","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Ampache API'sinin tasarımından dolayı bu parolalar yeterince güvenli bir şekilde depolanamadığından, burada Ampache API'si ile kullanılacak parolaları oluşturabilirsiniz. İstediğiniz kadar parola oluşturup; ardından istediğiniz zaman geçersiz kılabilirsiniz.","Invalid path":"Geçersiz yol","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Ampache API'nin henüz bir önizleme olup, kararlı olmadığını unutmayın. Bu özellikle ilgili deneyiminizi ilgili <a href=\"https://github.com/owncloud/music/issues/60\">sorunlar</a> kısmında bildirmekten çekinmeyin. Ayrıca test edilmesi gereken istemcilerin listesini de edinmek isterim. Teşekkürler.","Music":"Müzik","Next":"Sonraki","Path to your music collection":"Müzik koleksiyonunuzun yolu","Pause":"Beklet","Play":"Oynat","Previous":"Önceki","Repeat":"Tekrarla","Revoke API password":"API parolasını geçersiz kıl","Shuffle":"Karıştır","Some not playable tracks were skipped.":"Bazı oynatılamayan parçalar atlandı.","This setting specifies the folder which will be scanned for music.":"Bu ayar, müzik için taranacak klasörü belirtir.","Tracks":"Parçalar","Unknown album":"Bilinmeyen albüm","Unknown artist":"Bilinmeyen sanatçı","Use this address to browse your music collection from any Ampache compatible player.":"Herhangi Ampache uyumlu çalardan müzik koleksiyonunuza göz atmak için bu adresi kullanın.","Use your username and following password to connect to this Ampache instance:":"Bu Ampache örneğine bağlanmak için kullanıcı adınızı ve aşağıdaki parolayı kullanın:"});
    gettextCatalog.setStrings('tzm', {});
    gettextCatalog.setStrings('ug', {"Description":"چۈشەندۈرۈش","Music":"نەغمە","Next":"كېيىنكى","Pause":"ۋاقىتلىق توختا","Play":"چال","Previous":"ئالدىنقى","Repeat":"قايتىلا"});
    gettextCatalog.setStrings('uk', {"Albums":"Альбоми","Artists":"Виконавці","Description":"Опис","Description (e.g. App name)":"Опис (наприклад назва додатку)","Generate API password":"Сгенерувати пароль для API","Here you can generate passwords to use with the Ampache API, because they can't be stored in a really secure way due to the design of the Ampache API. You can generate as many passwords as you want and revoke them anytime.":"Тут ви можете згенерувати пароль для використання з Ampache API, оскільки вони не можуть бути збережені дійсно безпечним чином через конструкцію Ampache API. Ви можете створити стільки паролей, скільки необхідно, та відмовитись від них в будь який час.","Invalid path":"Невірний шлях","Keep in mind, that the Ampache API is just a preview and is unstable. Feel free to report your experience with this feature in the corresponding <a href=\"https://github.com/owncloud/music/issues/60\">issue</a>. I would also like to have a list of clients to test with. Thanks":"Пам'ятайте, що Ampache API є демо-версією і тому не стабільна. Ми будемо вдячні, якщо ви поділитеся досвідом роботи з цією функцією у відповідному <a href=\"https://github.com/owncloud/music/issues/60\">розділі</a>. Я також хотів би створити список клієнтів для тестування. Дякую.","Music":"Музика","Next":"Наступний","Path to your music collection":"Шлях до вашої музичної колекції","Pause":"Пауза","Play":"Грати","Previous":"Попередній","Repeat":"Повторювати","Revoke API password":"Відкликати API пароль","Shuffle":"Перемішати","Some not playable tracks were skipped.":"Деякі треки, що не відтворюються, були пропущені.","This setting specifies the folder which will be scanned for music.":"Цей параметр вказує теку, в якій буде проведено пошук музики.","Tracks":"Доріжки","Unknown album":"Невідомий альбом","Unknown artist":"Невідомий виконавець","Use this address to browse your music collection from any Ampache compatible player.":"Використовуйте цю адресу, щоб переглядати вашу музичну колекцію в будь-якому програвачі, що підтримує Ampache.","Use your username and following password to connect to this Ampache instance:":"Використовуйте власний логін та пароль для з'єднання з даним Ampache:"});
    gettextCatalog.setStrings('ur', {});
    gettextCatalog.setStrings('ur_PK', {"Description":"تصریح","Next":"اگلا","Repeat":"دہرایں"});
    gettextCatalog.setStrings('uz', {});
    gettextCatalog.setStrings('vi', {"Description":"Mô tả","Music":"Âm nhạc","Next":"Kế tiếp","Pause":"Tạm dừng","Play":"Play","Previous":"Lùi lại","Repeat":"Lặp lại","Shuffle":"Ngẫu nhiên","Unknown album":"Không tìm thấy album","Unknown artist":"Không tìm thấy nghệ sĩ"});
    gettextCatalog.setStrings('yo', {});
    gettextCatalog.setStrings('zh_CN', {"Albums":"专辑页","Artists":"艺术家","Description":"描述","Description (e.g. App name)":"描述 (例如 App 名称)","Generate API password":"生成 API 密码","Invalid path":"无效路径","Music":"音乐","Next":"下一个","Path to your music collection":"音乐集路径","Pause":"暂停","Play":"播放","Previous":"前一首","Repeat":"重复","Revoke API password":"撤销 API 密码","Shuffle":"随机","Some not playable tracks were skipped.":"部分无法播放的音轨已被跳过。","This setting specifies the folder which will be scanned for music.":"将会在此设置指定的文件夹中扫描音乐文件。","Tracks":"音轨","Unknown album":"未知专辑","Unknown artist":"未知艺术家","Use this address to browse your music collection from any Ampache compatible player.":"使用此地址在任何与 Ampache 兼容的音乐播放器中查看您的音乐集。","Use your username and following password to connect to this Ampache instance:":"使用您的用户名和密码连接到此 Ampache 服务："});
    gettextCatalog.setStrings('zh_HK', {"Albums":"相簿","Artists":"歌手","Music":"音樂","Next":"下一首","Pause":"暫停","Play":"播放","Previous":"上一首"});
    gettextCatalog.setStrings('zh_TW', {"Albums":"專輯","Artists":"歌手","Description":"描述","Description (e.g. App name)":"描述 (例: App 名稱)","Generate API password":"產生 API 密碼","Invalid path":"無效的路徑","Music":"音樂","Next":"下一個","Path to your music collection":"您的音樂資料夾的路徑","Pause":"暫停","Play":"播放","Previous":"上一個","Repeat":"重覆","Revoke API password":"撤銷 API 密碼","Shuffle":"隨機播放","Some not playable tracks were skipped.":"部份無法播放的曲目已跳過。","Tracks":"曲目","Unknown album":"未知的專輯","Unknown artist":"未知的歌手"});
/* jshint +W100 */
}]);

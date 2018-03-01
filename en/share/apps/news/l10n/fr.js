OC.L10N.register(
    "news",
    {
    "Feed contains invalid XML" : "Le flux contient un XML non valide",
    "Feed not found: either the website does not provide a feed or blocks access. To rule out blocking, try to download the feed on your server's command line using curl: curl http://the-feed.tld" : "Flux introuvable : le site n'en propose peut-être pas, ou en bloque l'accès. Pour vérifier si l'accès au flux est possible, vous pouvez essayer de le télécharger depuis votre serveur en ligne de commande avec curl : curl http://addresse-du/flux",
    "Detected feed format is not supported" : "Format de flux détecté non compatible",
    "SSL Certificate is invalid" : "Le certificat SSL n'est pas valable",
    "Website not found" : "Site web non trouvé",
    "More redirects than allowed, aborting" : "Nombre de redirections maximum dépassé, abandon",
    "Bigger than maximum allowed size" : "Taille supérieure au maximum autorisé",
    "Request timed out" : "Temps de réponse de la requete dépassé",
    "Request failed, network connection unavailable!" : "Échec de la requête, connexion réseau indisponible !",
    "Request unauthorized. Are you logged in?" : "Requête non autorisée. Êtes-vous bien connecté avec vos identifiants ?",
    "Request forbidden. Are you an admin?" : "Requête interdite. Avez-vous les droits admin ?",
    "Token expired or app not enabled! Reload the page!" : "Le jeton a expiré ou l'application n'est pas activée ! Veuillez recharger la page !",
    "Internal server error! Please check your " : "Erreur interne du serveur ! Veuillez vérifier votre",
    "Request failed, ownCloud is in currently " : "Échec de la requêtes, ownCloud est",
    "Can not add feed: Exists already" : "Impossible d'ajouter le flux : déjà présent",
    "Articles without feed" : "Articles sans flux",
    "Can not add folder: Exists already" : "Impossible d'ajouter le dossier : déjà présent",
    "Use ownCloud cron for updates" : "Utiliser la tâche cron ownCloud pour les mises à jour",
    "Disable this if you run a custom updater such as the Python updater included in the app" : "Désactiver ceci si vous utilisez un logiciel de mise à jour particulier tel que le logiciel de mise à jour Python inclus dans l'application",
    "Purge interval" : "Intervalle de purge",
    "Minimum amount of seconds after deleted feeds and folders are removed from the database; values below 60 seconds are ignored" : "Nombre minimum de secondes après lequel les flux et dossiers supprimés seront effacés de la base de données. Les valeurs inférieures à 60 secondes seront ignorées.",
    "Maximum read count per feed" : "Nombre maximum de lecture par flux",
    "Defines the maximum amount of articles that can be read per feed which won't be deleted by the cleanup job; if old articles reappear after being read, increase this value; negative values such as -1 will turn this feature off completely" : "Définit la quantité maximale d'articles pouvant être lus par flux qui ne seront pas supprimés par la tâche de nettoyage. Si d'anciens articles réapparaissent après avoir été lus, augmentez cette valeur. Une valeur négative comme -1 désactivera complètement cette fonctionnalité",
    "Maximum redirects" : "Nombre maximal de redirections",
    "How many redirects the feed fetcher should follow" : "Nombre de redirections que le récupérateur de flux doit suivre",
    "Maximum feed page size" : "Taille maximum de page de flux",
    "Maximum feed size in bytes. If the RSS/Atom page is bigger than this value, the update will be aborted" : "Taille maximum de flux en octets. Si la taille de la page RSS/Atom dépasse cette valeur, la mise à jour sera abandonnée.",
    "Feed fetcher timeout" : "Délai d'attente maximum du récupérateur de flux",
    "Maximum number of seconds to wait for an RSS or Atom feed to load; if it takes longer the update will be aborted" : "Nombre maximal de secondes que peut prendre un flux RSS ou Atom pour être chargé. Si le délai est dépassé, la mise à jour sera annulée",
    "Explore Service URL" : "URL du service d'exploration",
    "If given, this service's URL will be queried for displaying the feeds in the explore feed section. To fall back to the built in explore service, leave this input empty" : "Si indiquée, l'URL de ce service sera interrogée pour afficher les flux dans la section \"Explorer\". Pour revenir au service d'exploration par défaut, laissez ce champ vide.",
    "Saved" : "Sauvegardé",
    "Download" : "Télécharger",
    "Close" : "Fermer",
    "Ajax or webcron cron mode detected! Your feeds will not be updated correctly. It is recommended to either use the operating system cron or a custom updater." : "Cron ajax ou webcron détecté ! Vos flux ne seront pas correctement mis à jour. Il est recommandé d'utiliser le cron du système d'exploitation ou un outil personnalisé.",
    "How to set up the operating system cron" : "Comment configurer le cron du système d'exploitation",
    "How to set up a custom updater (faster and no possible deadlock) " : "Comment mettre en place un outil de mise à jour personnalisé (plus rapide et sans interblocage possible)",
    "Subscribe" : "S'abonner",
    "Refresh" : "Rafraîchir",
    "No articles available" : "Aucun article disponible",
    "No unread articles available" : "Aucun article non lu disponible",
    "Open website" : "Ouvrir le site web",
    "Star article" : "Épingler l'article",
    "Unstar article" : "Désépingler l'article",
    "Keep article unread" : "Marquer l'article comme non lu",
    "Remove keep article unread" : "Marquer l'article comme lu",
    "by" : "par",
    "from" : "de",
    "Play audio" : "Ecouter",
    "Download video" : "Télécharger la vidéo",
    "Download audio" : "Télécharger le son",
    "Keyboard shortcut" : "Raccourcis clavier",
    "Description" : "Description",
    "right" : "droite",
    "Jump to next article" : "Aller au prochain article",
    "left" : "gauche",
    "Jump to previous article" : "Aller à l'article précédent",
    "Toggle star article" : "Épingler / Désépingler l'article",
    "Star article and jump to next one" : "Épingler l'article et aller au suivant",
    "Toggle keep current article unread" : "Marquer l'article comme Lu / Non lu",
    "Open article in new tab" : "Ouvrir l'article dans un nouvel onglet",
    "Toggle expand article in compact view" : "Étendre / Réduire la vue (si en vue compacte)",
    "Load next feed" : "Charger le flux suivant",
    "Load previous feed" : "Charger le flux précédent",
    "Load next folder" : "Charger le dossier suivant",
    "Load previous folder" : "Charger le dossier précédent",
    "Scroll to active navigation entry" : "Aller à l'élément actif",
    "Focus search field" : "Sélectionner le champ de recherche",
    "Mark current article's feed/folder read" : "Marquer comme lu le flux / le répertoire de l'article en cours",
    "Web address" : "Adresse web",
    "Feed exists already!" : "Le flux existe déjà !",
    "Folder" : "Dossier",
    "No folder" : "Aucun dossier",
    "New folder" : "Nouveau dossier",
    "Folder name" : "Nom du dossier",
    "Go back" : "Revenir en arrière",
    "Folder exists already!" : "Le dossier existe déjà !",
    "New Folder" : "Nouveau dossier",
    "Create" : "Créer",
    "Explore" : "Explorer",
    "Deleted feed" : "Flux supprimé",
    "Undo delete feed" : "Annuler la suppression du flux",
    "Rename" : "Renommer",
    "Menu" : "Menu",
    "Unpin feed from the top" : "Désépingler le flux du haut de liste",
    "Pin feed to the top" : "Epingler le flux en haut de liste",
    "No feed ordering" : "Ordre actuel du flux: ordre original",
    "Reversed feed ordering" : "Ordre actuel du flux: antichronologique",
    "Normal feed ordering" : "Ordre actuel du flux: chronologique",
    "Enable full text feed fetching" : "Activer le chargement intégral du corps des articles",
    "Disable full text feed fetching" : "Désactiver le chargement intégral du corps des articles",
    "Keep updated articles as is" : "Garder les articles mis à jour tels quels",
    "Mark updated articles unread" : "Marquer les articles mis à jour comme non lus",
    "Rename feed" : "Renommer le flux",
    "Delete feed" : "Supprimer le flux",
    "Mark all articles read" : "Marquer tous les articles comme lus",
    "Dismiss" : "Ignorer",
    "Collapse" : "Replier",
    "Deleted folder" : "Dossier supprimé",
    "Undo delete folder" : "Annuler la suppression du dossier",
    "Rename folder" : "Renommer le dossier",
    "Delete folder" : "Supprimer le dossier",
    "Starred" : "Épinglés",
    "Unread articles" : "Articles non lus",
    "All articles" : "Tous les articles",
    "Settings" : "Paramètres",
    "Keyboard shortcuts" : "Raccourcis clavier",
    "Disable mark read through scrolling" : "Ne pas marquer les articles comme lus lors du parcours des listes",
    "Compact view" : "Vue compacte",
    "Expand articles on key navigation" : "Etendre les articles lors de la navigation avec le clavier",
    "Show all articles" : "Montrer tous les articles",
    "Reverse ordering (oldest on top)" : "Ordre inverse (les plus anciens en haut)",
    "Subscriptions (OPML)" : "Abonnements (OPML)",
    "Import" : "Importer",
    "Export" : "Exporter",
    "Error when importing: file does not contain valid OPML" : "Erreur lors de l'import : le fichier spécifié n'est pas un fichier OPML valide",
    "Unread/Starred Articles" : "Articles non lus / épinglés",
    "Error when importing: file does not contain valid JSON" : "Erreur lors de l'import : le fichier spécifié n'est pas un fichier JSON valide"
},
"nplurals=2; plural=(n > 1);");
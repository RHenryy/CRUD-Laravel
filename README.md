# CRUD-Laravel avec Authentification et Permissions
Création d'un crud à l'aide du framework Laravel avec système d'authentification et de permissions. 
Basé sur un site de location d'appartements.

Différents status : admin, agents, et utilisateurs. 

Le/Les admin(s) ont accès à toutes les fonctionnalités, comme l'ajout d'agences, suppressions d'annonces, gestion des membres et le statut de ces derniers.

Les agents ne peuvent pas intéragir avec les agences, mais peuvent gérer leurs propres annonces de location. Ils peuvent gérer plusieurs locations en même temps s'ils ont les droits. 
Ils ont également accès aux pages "messages", qui contiendront les demandes de rendez-vous envoyés par les potentiels clients. Les agents peuvent les consulter, et décider de les archiver. Une fois archivés, ces messages sont supprimés de la base de donnée principale, et copier dans une autre. Les agents peuvent accéder aux archives et consulter les anciens messages, et décider, s'ils le souhaitent, de les restaurer. Dans ce cas, ce sera simplement le processus inverse qu iaura lieu. 

Les utilisateurs n'ont pas plus de droits que les utilisateurs non enregistrés, à part la consultation de leur profil. On pourrait cependant imaginer un historique des messages envoyés par chaque utilisateur également par exemple. 

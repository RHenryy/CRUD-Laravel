# CRUD-Laravel avec Authentification et Permissions
Création d'un crud à l'aide du framework Laravel avec système d'authentification et de permissions. 
Basé sur un site de location d'appartements.

Différents status : admin, agents, et utilisateurs. 

Chaque statut a accès à des blades différentes. Les blades sont sécurisées, et une personne n'ayant pas le statut nécessaire tombera sur une erreur 403 avant d'être redirigée.

Les admins ont accès à toutes les fonctionnalités, telles que l'ajout d'agences, la suppression d'annonces, la gestion des membres et le statut de ces derniers... Mais n'ont pas accès aux messages privés des agents.

Les agents ne peuvent pas intéragir avec les agences, mais peuvent gérer leurs propres annonces de location, bien qu'ils ne puissent pas les supprimer. Ils peuvent gérer plusieurs locations en même temps s'ils ont les droits. 
Ils ont également accès aux pages "messages", qui contiendront les demandes de rendez-vous envoyés par les potentiels clients. Les agents peuvent les consulter, et décider de les archiver. Une fois archivés, ces messages sont supprimés de la base de donnée principale, et copier dans une autre. Les agents peuvent accéder aux archives et consulter les anciens messages, et décider, s'ils le souhaitent, de les restaurer. Dans ce cas, ce sera simplement le processus inverse qui aura lieu. 

Les utilisateurs n'ont pas plus de droits que les utilisateurs non enregistrés, à part la consultation de leur profil. Tous les utilisateurs ont accès à l'historique des messages qu'ils ont envoyé.



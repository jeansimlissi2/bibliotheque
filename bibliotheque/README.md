# Bibliothèque en Ligne

Ce projet est une application web PHP pour une bibliothèque en ligne.

## Déploiement en Production

### Avec Coolify

1. Créez un nouveau service PHP dans Coolify.
2. Connectez une base de données MySQL.
3. Les variables d'environnement suivantes seront automatiquement définies par Coolify :
   - MYSQL_HOST
   - MYSQL_DATABASE
   - MYSQL_USER
   - MYSQL_PASSWORD
   - MYSQL_PORT (optionnel, défaut 3306)

### Configuration de la Base de Données

Assurez-vous que la base de données MySQL est créée et que les tables sont importées si nécessaire.

### Docker

Un Dockerfile est fourni pour le déploiement avec Docker.

```bash
docker build -t bibliotheque .
docker run -p 80:80 bibliotheque
```

Assurez-vous de définir les variables d'environnement pour la connexion DB.
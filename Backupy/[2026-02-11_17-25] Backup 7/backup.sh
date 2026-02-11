#!/bin/bash

# Ustawienia
SOURCE_DIR="/var/www/html" 
BACKUP_REPO_DIR="$HOME/backupy_repo"
DATE=$(date +"%Y-%m-%d_%H-%M")

# Logika numeracji - liczy foldery w repo i dodaje 1
NUM=$(ls -1 "$BACKUP_REPO_DIR" | grep "Backup" | wc -l)
NEW_NUM=$((NUM + 1))

FOLDER_NAME="[$DATE] Backup $NEW_NUM"

echo "--- Startuje backup: $FOLDER_NAME ---"

# Tworzenie folderu w repozytorium
mkdir -p "$BACKUP_REPO_DIR/$FOLDER_NAME"

# Kopiowanie strony i skryptów .sh
cp -r $SOURCE_DIR/* "$BACKUP_REPO_DIR/$FOLDER_NAME/"
cp $HOME/*.sh "$BACKUP_REPO_DIR/$FOLDER_NAME/" 2>/dev/null

# Wrzucanie na GitHub
cd "$BACKUP_REPO_DIR"
git add .
git commit -m "Automatyczny backup: $FOLDER_NAME"
git branch -M main
git push -u origin main

echo "--- Backup wysłany na GitHub! ---"

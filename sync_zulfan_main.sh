#!/bin/bash

# Nama branch yang ingin disinkronkan
BRANCH="zulfan_main"

echo "⏳ Checkout ke branch $BRANCH..."
git checkout $BRANCH

echo "🔍 Membuat backup branch sebelum force push..."
git branch backup_$BRANCH
git push origin backup_$BRANCH

echo "🧹 Menghapus semua file yang ada di branch $BRANCH di remote tracking..."
git ls-files -z | xargs -0 git rm --cached

echo "📥 Menambahkan semua file lokal kamu ke staging..."
git add .

echo "📝 Commit perubahan..."
git commit -m "Sinkronisasi branch $BRANCH dengan isi lokal"

echo "⏫ Push force ke remote $BRANCH..."
git push origin $BRANCH --force

echo "✅ Selesai. Branch $BRANCH sekarang 100% sama dengan lokal kamu."
echo "📌 Backup branch ada di: backup_$BRANCH"
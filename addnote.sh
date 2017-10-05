#!/bin/bash

echo $(date)
read -p 'Date: ' date
read -p 'Note: ' note
id=$(sqlite3 stuff.db 'select max(id)+1 from notes')
$(sqlite3 stuff.db "insert into notes (id, date, note) values ($id, '$date', '$note')")



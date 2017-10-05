#!/bin/bash

echo $(sqlite3 stuff.db 'select * from featcategories')
read -p 'Date: ' date
read -p 'Accomplishment: ' accomplishment
read -p 'Category: ' category
read -p 'Notes: ' notes
id=$(sqlite3 stuff.db 'select max(id)+1 from accomplishments')
$(sqlite3 stuff.db "insert into accomplishments (id, accomplishment, date, category, notes) values ($id, '$accomplishment','$date','$category','$notes')")


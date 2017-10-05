#!/bin/bash
if [ "$#" -eq 1 ]
then
	echo $(sqlite3 stuff.db "select * from featcategories")
	date=$(sqlite3 stuff.db "select date from accomplishments where id = $1")
	read -p "Date: $date " date1
	accomplishment=$(sqlite3 stuff.db "select accomplishment from accomplishments where id = $1")
	read -p "Accomplishment: $accomplishment " accomplishment1
	category=$(sqlite3 stuff.db "select category from accomplishments where id = $1")
	read -p "Category:  $category " category1
	notes=$(sqlite3 stuff.db "select notes from accomplishments where id = $1")
	read -p "Notes: $notes " notes1
	$(sqlite3 stuff.db "insert into accomplishments (id, accomplishment, date, category, notes) values ($id, '$accomplishment','$date','$category','$notes')")
fi


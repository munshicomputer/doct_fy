# doctfy_api
Doctor Review App Api

//----------Department Related Work------------------
 
_________Get all Record from Department Table__________
...Request Method is GET...
api End point is : https://munshi-music.000webhostapp.com/doctfy_api/api/department/read.php
this end point return a JSON Array Response.

_________Get One Record From Department Table__________
...Request Method is GET... and it also has a header called 'id' put the id for record data update
api End point is : https://munshi-music.000webhostapp.com/doctfy_api/api/department/read_single.php
this end point return a JSON Object Response for id column.

__________Insert data to Department Table___________
...Request Method is POST...
URLPrams need a json object to insert data in Department Table.
{
    "id": "",
    "dept_name": "",
    "description": ""
}
api End point is : https://munshi-music.000webhostapp.com/doctfy_api/api/department/create.php

__________Update data to department Table___________
...Request Method is POST...
URLPrams need a json object to insert data in Department Table.
{
    "id": "",
    "dept_name": "",
    "description": ""
}
api End point is : https://munshi-music.000webhostapp.com/doctfy_api/api/department/update.php
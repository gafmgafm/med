# MED

MED is an open source database of medical facts.

## Getting Started

Download the repository. You'll need:

* PHP 7
* PDO Sqlite enabled in your PHP environment

First we will convert the data in csv format to sqlite database so we can use in the data entry tool.

```
cd <project_home>/tools/data
php csvtosqlite.php
```

Now we can use the data entry tool

```
cd <project_home>/tools/dataentry
php -S localhost:8080
```

Now open in your browser localhost:8080 and use the data entry tool.

Once you have finished editing the data, we will convert back to csv format so it can be sent to the repository.

```
cd <project_home>/tools/data
php sqlitetocsv.php
```
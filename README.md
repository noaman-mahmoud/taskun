```bash
composer install
```
```bash
php artisan migrate --seed
```

## Usage for create new section in dashboard

```bash
php artisan make:fullsection SectionName arabicSingleName arabicPluralName 
```
## tips 
- SectionName It must be singular, not plural, and begins with the capital letter 
- arabicSingleName The name of the section in Arabic singular
- arabicPluralName The name of the section in Arabic plural
- this command create for you meny files (Controller in Admin Folder , Model in Models folder , DataBase Migrate , Blade Folder in admin folder And Blade File , basic [index - store - update - delete] routes in web.php file for dashboard use )
- you can use ( --seed ) optional with command to create new Seeder for this section 
- you can use ( --ob ) optional with command to create new Observer for this section 
- you can use ( --request ) optional with command to create new form request file and folder in Request/Admin  for this section 
- you can use ( --resource ) optional with command to create new resource for this section in Resources/Api Folder



## Example
- for create new section for banks in dashboard run command  
```bash 
php artisan make:fullsection Bank بنوك بنك --seed --ob --request --resource 
```
--- command create new files to use 

- new Controller (BankController.php) with 4 main functions (index - store - update - delete ) 

- new model (Bank.php) with its database migration

- new folder (banks) in resources/Admin folder and new blade file (index.blade.php) in this folder contains base structer of file edit it as you need 

- new seeder file (BanksTableSeeder) if you use (--seed) with command 

- new observer file (BankObserver) if you use (--ob) with command 

- new form Request folder (Banks) and request File (Store.php) in Requests/Admin

- new Resource for Api use in Resources/APi

-  new [show - store - update -delete ] routes in web.php to use in dashboard 



## Example
- for create new section for banks in dashboard run command  
```bash 
php artisan make:semisection Bank  --seed --ob --request --resource 
```
--- command create new files to use 

-- new model (Bank.php) with its database migration

-- new seeder file (BanksTableSeeder) if you use (--seed) with command 

-- new observer file (BankObserver) if you use (--ob) with command 

-- new Resource for Api use in Resources/APi




# Covid vaccination challenge
## About this project



## Setup Process
1. `git clone`
2. `composer install`
3. create `.env` file from `.env.example`
4. generate APP KEY by `php artisan key:generate`
5. paste the DB credentials
6. `php artisan migrate`
7. run the `sparkcommerce` commands (Not needed for this project)
8. run the `scmv` commands
    * publish User roles using `php artisan scmv:publish-roles`
    * create first admin user `php artisan make:scmv-admin-user`
    * create first vendor owner user `php artisan make:scmv-vendor-owner-user`
9. serve the app using `php artisan serve`
10. for vendor dashboard visit http://127.0.0.1:8000/vendor/login
11. for admin dashboard visit http://127.0.0.1:8000/backoffice/login

### Find the coding implementation of the packages

* [sparkcommerce-rest-routes\src\Http\Controllers\](https://github.com/rahat1994/sparkcommerce-rest-routes/tree/main/src/Http/Controllers)
* [sparkcommerce-multivendor-rest-routes\src\Http\Controllers\](https://github.com/rahat1994/sparkcommerce-multivendor-rest-routes/tree/main/src/Http/Controllers)

## Features

### SparkCommerce
- [x] DashBoard
- [x] Product CRUD
- [x] Tags CRUD
- [x] Categories CRUD
- [x] Orders
- [x] Coupons CRUD 
- [x] Checkout
- [ ] Using Sale price during checkout
- [ ] Use coupons during checkout
- [ ] Anlytics
- [ ] Export/Import products
- [ ] Export/Import Orders
- [ ] Export/Import Categories
- [ ] Export/Import Tags

### SparkCommerce Multivendor
- [x] Vendor CRUD
- [x] Advertisement CRUD
- [x] Shop Categories CRUD
- [x] Support ticket CRUD
- [ ] Vendor Request
- [ ] Payout Request
- [ ] Deactivating vendor
- [ ] Conflict resolution
- [ ] Platform Commision

# Covid vaccination challenge

## Setup Process
1. `git clone`
2. `composer install`
3. create `.env` file from `.env.example` by `cp .env.example .env`
4. generate APP KEY by `php artisan key:generate`
5. paste the DB credentials inside `.env` file
6. `php artisan migrate`
7. run `php artisan db:seed --class=VaccineCenterSeeder`
8. run `npm install`
9. run `npm run dev`
10. serve the app using `php artisan serve`
11. run `php artisan queue:work` is important for background jobs.
12. for vendor dashboard visit http://127.0.0.1:8000/ for search page
13. for vendor dashboard visit http://127.0.0.1:8000/register for register page

## Testing
`php artisan test`

### Things to be done
- [x] Adding indexes to optimize query performance.
- [x] Offload scheduling process to a background job.
- [ ] What happens if a person signs up for that day after scheduling email is sent out.
- [ ] Eleminate any race condition when looking for next schedule.
- [ ] Make the `getNextSchedule` function effecient.
- [ ] 
- [ ] 

# Quality Audit App
A Quality Audit Application based on Laravel
## Features
Create An Audit Form, which can then be assigned to a campaign or Client. Establish the goal percentage for this form. The total points for the form will be calculated by the sum of the value of it's questions. 
Each question has a value. The portion of points of each question will be determined by the question option selected when filling the audit form.
## Instalation
1. Require it using composer: `composer require daisys/qa_app`
1. The package relies on packages [dainsys/components](https://github.com/Yismen/laravel-components) and [dainsys/locky](https://github.com/Yismen/locky). __Make sure you fallow their installation guides.__
1. Add links menu
### Publishing Assets
* You can publish config running command `php artisan vendor:publish --tag=qa_app.config`
* You can publish and customize the views by running command `php artisan vendor:publish --tag=qa_app.views`
* To publish the migrations just run `php artisan vendor:publish --tag=qa_app.migrations`
* Alternatively, you can publish all assets by running `php artisan vendor:publish --provider=Dainsys\QAApp\QAAppServiceProvider`
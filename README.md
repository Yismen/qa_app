# Quality Audit App
A Quality Audit Application based on Laravel
## Features
Create An Audit Form, which can then be assigned to a campaign or Client. Establish the goal percentage for this form. The total points for the form will be calculated by the sum of the value of it's questions. 
Each question has a value. The portion of points of each question will be determined by the question option selected when filling the audit form.
## Instalation
1. Require it using composer: `composer require dainsys/qa_app`
1. The package relies on packages [dainsys/components](https://github.com/Yismen/laravel-components) and [dainsys/locky](https://github.com/Yismen/locky). __Make sure you fallow their installation guides.__
1. Migrate the database tables by running the `php artisan migrate` command.
1. Import app navigations by adding the `@include('qa_app::_nav-links')` in your nav-bar
### Publishing Assets
It is totally optional, but a good practice to publish packages assets. To do so:
* You can publish config running command `php artisan vendor:publish --tag=qa_app.config`
* You can publish and customize the views by running command `php artisan vendor:publish --tag=qa_app.views`
* To publish the migrations just run `php artisan vendor:publish --tag=qa_app.migrations`
* Alternatively, you can publish all assets by running `php artisan vendor:publish --provider=Dainsys\QAApp\QAAppServiceProvider`
### Initial Configuration
1. Create QA Forms using route `.../qa_app/form`. Forms are the master piece of the process. They hold the results of each evaluation. 
1. Define your types of questions by visiting route `.../qa_app/question_type`
    - Good options are `True Or False`, `Scales`
1. Define your question options by visiting route `.../qa_app/question_option`. Define which percentage of the points belongs to each option. True or False could be 100% for true, 0% for false. Do the same for your scales questions.
    - Define the percentage of points required to pass the audit. In other words, what percentage of the sum of points of the questions associated to a form needs to be reached to pass an audit.
1. Create all the questions and associate them to a form and to a question type using route `.../qa_app/question`. Assign how many points each question weights withing the audit form.
1. Create app roles and assign them to your users in route `/locky/roles`:
    - For Admin users, default role name is `QA App Admin` as defined in the package config file. Feel free to publish and update as needed.
    - For Auditor users, default role name is `QA App Auditor` as defined in the package config file. Feel free to publish and update as needed.
    - For User users, default role name is `QA App User` as defined in the package config file. Feel free to publish and update as needed.
1. Make sure your layouts view can recieve the javascripts by adding the `@stack('scripts')` directive.
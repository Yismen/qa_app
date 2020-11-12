<?php

namespace Dainsys\QAApp\Tests;

use Dainsys\QAApp\Tests\Feature\AdminTestsTrait;
use Dainsys\QAApp\Tests\Feature\AuditTestsTrait;
use Dainsys\QAApp\Tests\Feature\FormTestsTrait;
use Dainsys\QAApp\Tests\Feature\QuestionOptionTestsTrait;
use Dainsys\QAApp\Tests\Feature\QuestionTestsTrait;
use Dainsys\QAApp\Tests\Feature\QuestionTypeTestsTrait;

class SuiteTest extends AppTestCase
{
    use AdminTestsTrait;
    use AuditTestsTrait;
    use FormTestsTrait;
    use QuestionOptionTestsTrait;
    use QuestionTestsTrait;
    use QuestionTypeTestsTrait;
}


## Introduction

Foundation package for laravel version 9. This package provide foundation for laravel to use its features more smoothly.

## Installation
Just install samsin33/laravel-foundation package with composer.
```bash
$ composer require samsin33/laravel-foundation
```

## Foundation Model
This package is developed to use the Eloquent features in most awesome way:  
To create model use the foundation:make-model command. This command will also take additional attributes like --controller, etc. which are there in the laravel documentation.
```bash
$ php artisan foundation:make-model Post
```
The Post model will be created in your app/Models folder which extends the Samsin33\Foundation\Models\BaseModel class.  
Samsin33\Foundation\Models\BaseModel class extends the Illuminate\Database\Eloquent\Model class, so you can do all the functionalities of eloquent model.

## Importance
The foundation model performs the below features in very simple way.

## Validations
To create validations for a model just define function getValidationRules() this should return the validation array.  
To define the custom validation messages define function getValidationMessages() which will also return array of validation messages.  
To get error messages use Eloquent object errors(), E.g. $post->errors()->all().

Sometimes if you do not want to validate data use saveWithoutValidate().
Sometimes we wish to validate some fields conditionally, E.g. password, status, etc. Use setValidationType(), removeValidationType() and isValidationType() in that case.

**Note:** The validation is happening in the saving event, so it will be called every time in the while creating or updating an Eloquent object.
```bash
use Samsin33\Foundation\Models\BaseModel;

class Post extends BaseModel
{
    protected function getValidationRules(): array
    {
        $arr = [
          'title' => ['required', 'max:255'],
          'description' => ['required']
        ];
        if ($this->isValidationType('check_status')) {
          $arr['status'] = ['required', 'integer'];
        }
        return $arr;
    }

    protected function getValidationMessages()
    }: array
    {
        return [
          'title.required' => 'A title is required',
          'title.max' => 'Title should be maximum of 255 length',
          'description.required' => 'A description is required'
        ];
    }
}

// You can get errors from model objects. In controller function write code:

function save(Request $request) {
    $post = new Post(['title' => $request->title, $request->description]);
    if (some condition) {
      $post->setValidationType('check_status');
    }
    if ($post->save()) {
    } else {
      $post->errors()->all();
      // or
      $post->showErrors();
      // Other validation functions can also apply check laravel validation documentation.
    }
    // If you want to remove any set validation type use
    $post->removeValidationType('check_status');
    
    // if no validation required then do:
    $post->saveWithoutValidate();
}
```

## Events
Laravel Eloquent has 14 events which are: retrieved, creating, created, updating, updated, saving, saved, deleting, deleted, trashed, forceDeleted, restoring, restored, and replicating.
To use events in model you just need to define the event name followed by Event function.
E.g. savingEvent(), updatedEvent(), deletingEvents().

In the ***ing events** the operation will stop if you return false.

**Note:** The validations are happening in the savingEvent() so call the parent::savingEvent() in that and make sure to return false if parent::savingEvent() is false.
```bash
use Samsin33\Foundation\Models\BaseModel;

class Post extends BaseModel
{
  public function savingEvent()
    {
        if (parent::savingEvent()) {
             // do something
             return $this;
        }
        return false;
    }
    
    // To delete all comments if the post is deleted
    public function deletedEvent()
    {
        Comment::where('post_id', $this->id)->delete();
    }
}
```

## Queue
If you want to push something to queue call the dispatchQueue(). This function will take 2 arguments 1st is the function name and 2nd is the data array.  
You need to define the function by the name given in the 1st argument with $data argument.  
If you want to use the current user attributes in that function at the time post delete() is called use $this->queue_user attribute.  
In the above example lets delete all post comments on queue.
```bash
use Samsin33\Foundation\Models\BaseModel;

class Post extends BaseModel
{
  // To delete all comments if the post is deleted
    public function deletedEvent()
    {
        $addition_data = ['some_data'];
        $this->dispatchQueue('deletePostComments', $addition_data);
    }

    // This function will be called once the queue is executed.
    public function deletePostComments($data)
    {
        // $data will have $addition_data values
        Comment::where('post_id', $this->id)->delete();
        // To access the user details at the time post delete() is called use $this->queue_user attribute.
    }
}
```

## Cache
The CacheTrait contains very useful functions which makes caching very simple.  
Suppose there is a Category model where you want to cache the active and inactive categories.  
You need to update the $is_cached, $cache_fields, $cache_conditions attributes.
```bash
use Samsin33\Foundation\Models\BaseModel;

class Category extends BaseModel
{
  protected static bool $is_cached = false;
  protected static $cache_fields = ['id', 'name', 'status'];
  protected static $cache_conditions = ['active' => ['status' => 1], 'inactive' => ['status' => 0]];
}

// To get or set cache use Category object.
$category = new Category();
or
$category = Category::first();
$category->getCache('active');
$category->getCache('inactive');

// resetAllCache function will reset all cache_conditions data of model.
$category->resetAllCache();
```

## Mail
MailerTrait contains the sendMail() which will send the email.
The function will take the following arguments:  
$email_to,  
string $view,  
string $subject = '', (optional)  
array $data = [], (optional)  
array $cc = [], (optional)  
array $bcc = [], (optional)  
int $reset_email_from = 0, (optional)  
array $attach = [], (optional)  
array $reply_to = []. (optional)

In the view file you can access the attributes with $data variable.  
$data will contain 2 keys:  
**$data['object']** - which contains the model object.  
**$data['other_data']** - contains the value in the above $data argument passed in sendMail().

You can also send the exception email by using function sendExceptionEmail() in which case you need to add the exception_email key in your mail config file.  
The 1st argument take **$exception** variable which can be an array. The **$exception** data will be available in your view file as **$data['other_data']**.

**Note:** You can use MailerTrait in Exceptions/Handler.php file also to call exception email function.
```bash
config/mail.php
return [
  'exception_email' => 'email_to_receive_exception@mail.com'
];

Exceptions/Handler.php
$this->reportable(function (Throwable $exception) {
    $this->sendExceptionEmail(['exception' => $exception->getTraceAsString(), 'exception_view_blade_file']);
});
```

## Other Traits
Some other useful traits are:  
UserSessionTrait  
RequestTypeTrait  
DateTrait  
GuzzleHttpTrait

To get current user details you can use:  
currentUser()  
currentUserId()

You can check out the other traits to use their functions.

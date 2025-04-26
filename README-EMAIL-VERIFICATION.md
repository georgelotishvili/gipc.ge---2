# Email Verification System

The email verification system is currently disabled but can be easily enabled when needed. This README provides instructions on how to enable and configure the system.

## How to Enable Email Verification

1. **Update the User Model**:
   - Open `app/Models/User.php`
   - Uncomment the `MustVerifyEmail` import:
     ```php
     use Illuminate\Contracts\Auth\MustVerifyEmail;
     ```
   - Uncomment the `implements MustVerifyEmail` in the class definition:
     ```php
     class User extends Authenticatable implements MustVerifyEmail
     ```
   - Uncomment the `sendEmailVerificationNotification` method

2. **Enable Email Verification in Fortify Config**:
   - Open `config/fortify.php`
   - Uncomment the following line in the 'features' array:
     ```php
     Features::emailVerification(),
     ```

3. **Enable the Email Verification View in FortifyServiceProvider**:
   - Open `app/Providers/FortifyServiceProvider.php`
   - Uncomment the `verifyEmailView` registration:
     ```php
     // Register the email verification view
     Fortify::verifyEmailView(function () {
         return view('auth.verify-email');
     });
     ```

4. **Register the VerifyEmailMiddleware (Optional)**:
   - Open `app/Http/Kernel.php`
   - Find the `$routeMiddleware` array
   - Add the middleware:
     ```php
     'verify.email' => \App\Http\Middleware\VerifyEmailMiddleware::class,
     ```
   - Apply the middleware to routes that require email verification:
     ```php
     Route::middleware(['auth', 'verify.email'])->group(function () {
         // Protected routes that require email verification
     });
     ```

## How to Test Email Functionality

To test the email functionality:

1. **Enable the Email Test Routes**:
   - Open `routes/web.php`
   - Uncomment the EmailTestController import:
     ```php
     use App\Http\Controllers\EmailTestController;
     ```
   - Uncomment the email test routes:
     ```php
     // Test Email Routes
     Route::get('/send-test-email', [EmailTestController::class, 'sendTestEmail']);
     Route::get('/email-form', function() {
         return view('emails.form');
     });
     Route::post('/send-custom-email', [EmailTestController::class, 'sendCustomEmail']);
     ```

2. **Mailgun Configuration**:
   - Make sure your Mailgun configuration is in your `.env` file:
     ```
     MAIL_MAILER=mailgun
     MAILGUN_DOMAIN=your-domain.mailgun.org
     MAILGUN_SECRET=your-mailgun-api-key
     MAILGUN_ENDPOINT=api.mailgun.net
     MAIL_FROM_ADDRESS=email@your-domain.com
     MAIL_FROM_NAME="Your App Name"
     ```

3. **Authorize Recipients in Mailgun** (if using sandbox domain):
   - For sandbox domains, you need to authorize each recipient
   - Visit `https://app.mailgun.com/app/sending/domains/your-domain/authorized`
   - Add the email addresses you want to test with

4. **Testing**:
   - Visit `/send-test-email` to send a test email
   - Visit `/email-form` to send a custom email with your own content

## Notes

- Email verification and testing are kept separate to allow you to test email functionality without enabling full email verification
- When using Mailgun's sandbox domain, you can only send to authorized recipients
- Consider upgrading to a paid Mailgun account or adding a custom domain for production use 
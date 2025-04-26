# Email Verification with Mailgun Setup

This guide will help you set up email verification using Mailgun in your Laravel application.

## Prerequisites
- A Mailgun account (you can sign up at [mailgun.com](https://www.mailgun.com))
- A verified domain in Mailgun (or use the sandbox domain for testing)

## Configuration Steps

1. Install the Mailgun Laravel package:
```bash
composer require symfony/mailgun-mailer symfony/http-client
```

2. Add the following environment variables to your `.env` file:
```
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=your-domain.com
MAILGUN_SECRET=your-mailgun-api-key
MAILGUN_ENDPOINT=api.mailgun.net
```

Replace `your-domain.com` with your Mailgun domain and `your-mailgun-api-key` with your Mailgun API key.

3. Update the mail from address in your `.env` file:
```
MAIL_FROM_ADDRESS=no-reply@your-domain.com
MAIL_FROM_NAME="Your App Name"
```

## Testing Email Verification

1. Register a new user in your application
2. You should be redirected to the email verification page
3. Check your email for the verification link
4. Click the verification link to verify your email

## Troubleshooting

- If you're not receiving emails, check your Mailgun logs for any delivery issues
- Verify that your Mailgun domain is properly configured
- Check that your API key has the correct permissions

## Additional Information

This implementation uses a custom verification email notification that extends Laravel's built-in verification system. The custom template can be modified at `resources/views/emails/verify-email.blade.php`.

The User model has been configured to implement the `MustVerifyEmail` interface, which requires email verification before users can access certain parts of the application. 
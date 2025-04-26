<?php

namespace App\Services;

use Mailgun\Mailgun;
use Illuminate\Support\Facades\Log;
use Exception;

class MailgunService
{
    protected $client;
    protected $domain;
    protected $fromEmail;
    protected $fromName;
    protected $isConfigured = false;

    public function __construct()
    {
        try {
            $this->domain = env('MAILGUN_DOMAIN');
            $apiKey = env('MAILGUN_SECRET');
            
            if (empty($apiKey) || empty($this->domain)) {
                Log::warning('Mailgun is not properly configured. Missing API key or domain.');
                $this->isConfigured = false;
                return;
            }
            
            $this->client = Mailgun::create($apiKey);
            $this->fromEmail = env('MAIL_FROM_ADDRESS', 'no-reply@' . $this->domain);
            $this->fromName = env('MAIL_FROM_NAME', 'Laravel Application');
            $this->isConfigured = true;
        } catch (Exception $e) {
            Log::error('Failed to initialize Mailgun service: ' . $e->getMessage());
            $this->isConfigured = false;
        }
    }

    /**
     * Send an email using Mailgun API
     * 
     * @param string|array $to Recipient email or array of recipients
     * @param string $subject Email subject
     * @param string $text Plain text content
     * @param string|null $html HTML content (optional)
     * @param array $attachments Array of file paths to attach (optional)
     * @param array $cc Array of CC recipients (optional)
     * @param array $bcc Array of BCC recipients (optional)
     * @param array $tags Array of tags for tracking (optional)
     * @return array Response with success status and message
     */
    public function send($to, $subject, $text, $html = null, $attachments = [], $cc = [], $bcc = [], $tags = [])
    {
        if (!$this->isConfigured) {
            return [
                'success' => false,
                'message' => 'Mailgun is not properly configured'
            ];
        }

        try {
            $params = [
                'from' => "{$this->fromName} <{$this->fromEmail}>",
                'subject' => $subject,
                'text' => $text
            ];

            // Add recipients
            if (is_array($to)) {
                $params['to'] = implode(',', $to);
            } else {
                $params['to'] = $to;
            }

            // Add HTML content if provided
            if (!empty($html)) {
                $params['html'] = $html;
            }

            // Add CC recipients if provided
            if (!empty($cc)) {
                $params['cc'] = is_array($cc) ? implode(',', $cc) : $cc;
            }

            // Add BCC recipients if provided
            if (!empty($bcc)) {
                $params['bcc'] = is_array($bcc) ? implode(',', $bcc) : $bcc;
            }

            // Add tags for tracking
            if (!empty($tags)) {
                $params['o:tag'] = $tags;
            }

            // Add attachments if provided
            if (!empty($attachments)) {
                foreach ($attachments as $attachment) {
                    if (file_exists($attachment)) {
                        $params['attachment'][] = ['filePath' => $attachment, 'filename' => basename($attachment)];
                    }
                }
            }

            // Send the email
            $response = $this->client->messages()->send($this->domain, $params);

            return [
                'success' => true,
                'message' => 'Email sent successfully',
                'id' => $response->getId()
            ];
        } catch (Exception $e) {
            Log::error('Mailgun email sending failed: ' . $e->getMessage());
            
            // Check if this is the Mailgun free account restriction error
            if (strpos($e->getMessage(), 'Free accounts are for test purposes only') !== false) {
                return [
                    'success' => false,
                    'message' => 'Mailgun Free Account Restriction: You need to authorize the recipient email in your Mailgun account. 
                    Please go to https://app.mailgun.com/app/sending/domains/your-domain/authorized and add ' . $to . ' as an authorized recipient,
                    or upgrade to a paid Mailgun account to send to any recipient.'
                ];
            }
            
            return [
                'success' => false,
                'message' => 'Failed to send email: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Send a verification email to the user
     * 
     * @param object $user User model instance
     * @param string $verificationUrl Verification URL
     * @return array Response with success status and message
     */
    public function sendVerificationEmail($user, $verificationUrl)
    {
        $subject = 'Please Verify Your Email Address';
        $text = "Please click the button below to verify your email address.\n\n"
              . "Verification URL: {$verificationUrl}\n\n"
              . "If you did not create an account, no further action is required.";
        
        // Create HTML version of the email
        $html = $this->getVerificationEmailHtml($user->name, $verificationUrl);
        
        return $this->send($user->email, $subject, $text, $html, [], [], [], ['verification']);
    }

    /**
     * Send test email
     * 
     * @param string $to Recipient email
     * @return array Response with success status and message
     */
    public function sendTestEmail($to)
    {
        $subject = 'Test Email from Your Laravel App';
        $text = "This is a test email sent from your Laravel application using Mailgun.";
        $html = "<h1>Mailgun Test</h1><p>This is a test email sent from your Laravel application using Mailgun.</p>";
        
        return $this->send($to, $subject, $text, $html, [], [], [], ['test']);
    }

    /**
     * Generate HTML template for verification email
     * 
     * @param string $name Recipient name
     * @param string $verificationUrl Verification URL
     * @return string HTML content
     */
    private function getVerificationEmailHtml($name, $verificationUrl)
    {
        return '<!DOCTYPE html>
        <html>
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title>Verify Email Address</title>
            <style>
                @media only screen and (max-width: 620px) {
                    table.body h1 {
                        font-size: 28px !important;
                        margin-bottom: 10px !important;
                    }

                    table.body p,
                    table.body ul,
                    table.body ol,
                    table.body td,
                    table.body span,
                    table.body a {
                        font-size: 16px !important;
                    }

                    table.body .wrapper,
                    table.body .article {
                        padding: 10px !important;
                    }

                    table.body .content {
                        padding: 0 !important;
                    }

                    table.body .container {
                        padding: 0 !important;
                        width: 100% !important;
                    }

                    table.body .main {
                        border-left-width: 0 !important;
                        border-radius: 0 !important;
                        border-right-width: 0 !important;
                    }

                    table.body .btn table {
                        width: 100% !important;
                    }

                    table.body .btn a {
                        width: 100% !important;
                    }
                }
            </style>
        </head>
        <body style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" width="100%" bgcolor="#f6f6f6">
                <tr>
                    <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
                    <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;" width="580" valign="top">
                        <div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
                            <!-- START CENTERED WHITE CONTAINER -->
                            <table role="presentation" class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #ffffff; border-radius: 3px; width: 100%;" width="100%">
                                <!-- START MAIN CONTENT AREA -->
                                <tr>
                                    <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;" valign="top">
                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" width="100%">
                                            <tr>
                                                <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">
                                                    <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Hello ' . htmlspecialchars($name) . ',</p>
                                                    <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Please click the button below to verify your email address.</p>
                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; width: 100%;" width="100%">
                                                        <tbody>
                                                            <tr>
                                                                <td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;" valign="top">
                                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; border-radius: 5px; text-align: center; background-color: #3498db;" valign="top" align="center" bgcolor="#3498db">
                                                                                    <a href="' . $verificationUrl . '" target="_blank" style="border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; display: inline-block; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-decoration: none; text-transform: capitalize; background-color: #3498db; border-color: #3498db; color: #ffffff;">Verify Email Address</a>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">If you did not create an account, no further action is required.</p>
                                                    <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Regards,<br>Your Application Team</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <!-- END MAIN CONTENT AREA -->
                            </table>
                            <!-- END CENTERED WHITE CONTAINER -->
                        </div>
                    </td>
                    <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
                </tr>
            </table>
        </body>
        </html>';
    }

    /**
     * Check if the service is properly configured
     * 
     * @return bool
     */
    public function isConfigured()
    {
        return $this->isConfigured;
    }
} 
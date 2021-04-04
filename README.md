<h1>Knowledge App</h1>

<p>This application allows you to bookmark different kind of knowledge in one place.
If you example have found a useful video, a useful url or even you did something that 
you need to remember what, how and why you did it, you can store it in this app and
find it later with the ease of a button.</p>

<h2>How it works</h2>
<p>The only thing you need to do is to register a new account and start using it.
After that you can create a new "knowledge" (that is how the app names any new record) and
fill in all the information you want to keep forever. For a test drive you can visit 
<a href="http://knowledge.tkouleris.eu">http://knowledge.tkouleris.eu</a>.</p>

<h2>Installation</h2>
<ol>
    <li>Clone this repository</li>
    <li>Copy the .env.example to .env</li>
    <li>Set up your database information in .env</li>
    <li>Set up an email account from which the application will send you refresh password emails</li>
    <li>Type <code>composer install</code></li>
    <li>Type <code>php artisan jwt:secret</code></li>
    <li>Type <code>php artisan migrate</code></li>
    <li>Have fun!</li>
</ol>



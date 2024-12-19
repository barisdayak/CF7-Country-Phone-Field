# CF7-Country-Phone-Field
Plugin for WordPress Contact Form 7 that adds dynamic country code selection and phone number input field.

# <strong>Bd Country Flags Contact Form 7 Plugin</strong>  
<strong>Version:</strong> 2.0  <br>  
<strong>Developer:</strong> Barış Dayak  <br>  
<strong>Official Website:</strong> <a href="https://barisdayak.com" target="_blank">Barış Dayak Official Website</a>  

---
![preview1](https://github.com/user-attachments/assets/d86c20ef-1419-48fb-8e2d-95d9592ae231)
![preview2](https://github.com/user-attachments/assets/e7f13b65-f455-404a-91aa-6442ba8d188f)



<h2>Plugin Description</h2>  
<p>Bd Country Flags Contact Form 7 is a WordPress plugin that enhances Contact Form 7 by adding a custom phone input field with country flags. It provides a more professional and user-friendly experience for form submissions.</p>  

---

<h2>Note !</h2>  

<h3>Form Integration Guide </h3> 
<p>To integrate the phone number input field with country flags into Contact Form 7 forms, you need to add the following HTML structure inside your form template:</p> 
<pre><code>
&lt;label&gt;Phone Number&lt;/label&gt;
&lt;div class="select-box"&gt;
    &lt;div class="selected-option"&gt;
        &lt;div&gt;
            &lt;span class="iconify"&gt;&lt;/span&gt;
            &lt;strong&gt;+1&lt;/strong&gt;
        &lt;/div&gt;
        &lt;input type="tel" name="phone-number" placeholder="Phone Number" required&gt;
    &lt;/div&gt;
    &lt;div class="options"&gt;
        &lt;input type="text" class="search-box" placeholder="Country Search..."&gt;
        &lt;ol&gt;&lt;/ol&gt;
    &lt;/div&gt;
&lt;/div&gt;
</code></pre>


<h3>Functions.php Integration</h3> 
<p>To ensure proper backend processing of the phone number input field in Contact Form 7, add the following code to your theme's <code>functions.php</code> file:</p> 
<pre><code>
&lt;?php
// Register the shortcode for Contact Form 7
add_shortcode('country_phone', 'cf7_country_phone_shortcode');

function cf7_country_phone_shortcode($atts) {
    $atts = shortcode_atts(
        array(
            'name' =&gt; 'phone-number', // The name attribute of the form input
        ),
        $atts,
        'country_phone'
    );

    // Retrieve form data after submission
    $submission = WPCF7_Submission::get_instance();
    if ($submission) {
        $posted_data = $submission-&gt;get_posted_data();

        // Return the phone number if available
        if (!empty($posted_data[$atts['name']])) {
            return sanitize_text_field($posted_data[$atts['name']]);
        }
    }
    return 'Phone number not provided';
}

// Force shortcode processing in form elements
add_filter('wpcf7_form_elements', 'do_shortcode_for_cf7');
function do_shortcode_for_cf7($form) {
    return do_shortcode($form);
}

// Append shortcode result to the email body
add_filter('wpcf7_mail_components', 'cf7_add_country_phone_to_mail', 10, 3);
function cf7_add_country_phone_to_mail($mail_components, $contact_form, $instance) {
    $shortcode_output = do_shortcode('[country_phone name="phone-number"]');

    // Add phone number to the email body if available
    if (!empty($shortcode_output) && $shortcode_output !== 'Phone number not provided') {
        $mail_components['body'] .= "\nCountry Code and Phone: " . $shortcode_output;
    } else {
        $mail_components['body'] .= "\nCountry Code and Phone: Phone number not provided";
    }
    return $mail_components;
}
?&gt;
</code></pre>


---

<h2>Plugin Features</h2>  

<h3>1. Country Codes and Flags</h3>  
<ul>  
<li>Integrated list of 250+ country codes and flags.</li>  
<li>Users can easily select their country from a dropdown menu while entering their phone number.</li>  
<li>The selected country code and flag are automatically updated in the input field.</li>  
</ul>  

---

<h3>2. Default Country Code Setup</h3>  
<ul>  
<li>Developers can set a default country code (e.g., +90 for Turkey).</li>  
<li>The country code is automatically prefilled in the phone input field.</li>  
</ul>  

---

<h3>4. Admin Email Notifications</h3>  
<ul>  
<li>The submitted phone number, including the country code, is sent to the admin email upon form submission.</li>  
<li>Phone numbers are displayed clearly in the email content.</li>  
</ul>  

---

<h3>5. Dynamic Search Feature</h3>  
<ul>  
<li>Search the country list instantly using the search box.</li>  
<li>Filter countries by name in real-time while typing.</li>  
</ul>  

---

<h3>6. Full Customization Support</h3>  
<ul>  
<li>User-friendly interface with fully customizable design.</li>  
<li>Developers can easily adjust CSS and JavaScript for personal modifications.</li>  
</ul>  

---

<h3>7. Responsive Design</h3>  
<ul>  
<li>Responsive design that works perfectly on all devices.</li>  
<li>Fully compatible with mobile, tablet, and desktop screens.</li>  
</ul>  

---

<h2>About Barış Dayak</h2>  
<p>Barış Dayak is an experienced web developer specializing in WordPress web design and custom plugin development. He has contributed to numerous professional projects, helping businesses succeed online with innovative digital solutions.</p>  

<p>For more details, visit the <a href="https://barisdayak.com/wordpress-web-tasarim-uzmani/" target="_blank" rel="noopener noreferrer">Official Barış Dayak Website</a>.</p>

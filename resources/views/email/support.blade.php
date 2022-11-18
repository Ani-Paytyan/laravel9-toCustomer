<h2>Hello</h2> <br><br>
{{ __('page.support.title_email') }} : {{ $firstName ?? ' ' }} {{ $lastName ?? ' ' }} <br><br>
{{ __('page.support.user_details') }} : <br><br>
{{ __('attributes.user.name') }} : {{ $firstName ?? ''}} <br>
{{ __('attributes.user.last_name') }} : {{ $lastName ?? ''}} <br>
{{ __('attributes.user.email') }} : {{ $email }} <br>
{{ __('attributes.user.company_name') }} : {{ $company_name }} <br>
{{ __('page.support.subject') }}: {{ $subject }} <br>
{{ __('page.support.text') }}: {{ $support_text }} <br><br>
Thanks

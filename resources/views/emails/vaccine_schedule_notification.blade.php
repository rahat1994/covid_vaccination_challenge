{{ __(
    'Hello :user, Your vaccine appointment day is tomorrow at :location. Please be on time.',
    [
        'user' => $user->name,
        'location' => $vaccineCenter->name
    ])
}}

{{ __('Thank you') }},<br>
{{ config('app.name') }}

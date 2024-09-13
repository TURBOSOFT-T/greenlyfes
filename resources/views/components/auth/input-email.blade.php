@props(['email' => ''])

<div class="form-outline mb-4">
  <label for="email">@lang('Email')</label>
  <input
      id="email"
  class="form-control form-control-lg"
      type="email"
      name="email"
      pattern="[^@]+@[^@]+\.[^@]+"
      placeholder="@lang('Your email')"
      value="{{ old('email', $email) }}"
      required
      autofocus>
</div>

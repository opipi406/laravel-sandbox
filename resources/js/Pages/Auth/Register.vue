<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
});

const submit = () => {
  form.post(route("register"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
};
</script>

<template>
  <GuestLayout>
    <Head title="Register" />

    <form @submit.prevent="submit">
      <div class="line-login-button">
        <a :href="route('social_login.redirect', 'line')">
          <img src="/img/btn_login_base.png" alt="LINE Login" />
        </a>
      </div>
      <p class="text-xs text-gray-600 my-8">
        LINEアカウントを利用して会員登録を行います。<br />
        ログイン時の認証画面にて許可をいただいた場合のみ、<br />
        あなたのLINEアカウントに登録されているメールアドレスを取得します。<br />
        取得したメールアドレスは、以下の目的以外では使用しません。<br />
        ・通知、問い合わせ時の連絡のために利用<br />
        また、法令に定められた場合を除き、第三者への提供はいたしません。
      </p>

      <div>
        <InputLabel for="name" value="Name" />

        <TextInput
          id="name"
          type="text"
          class="mt-1 block w-full"
          v-model="form.name"
          required
          autofocus
          autocomplete="name"
        />

        <InputError class="mt-2" :message="form.errors.name" />
      </div>

      <div class="mt-4">
        <InputLabel for="email" value="Email" />

        <TextInput
          id="email"
          type="email"
          class="mt-1 block w-full"
          v-model="form.email"
          required
          autocomplete="username"
        />

        <InputError class="mt-2" :message="form.errors.email" />
      </div>

      <div class="mt-4">
        <InputLabel for="password" value="Password" />

        <TextInput
          id="password"
          type="password"
          class="mt-1 block w-full"
          v-model="form.password"
          required
          autocomplete="new-password"
        />

        <InputError class="mt-2" :message="form.errors.password" />
      </div>

      <div class="mt-4">
        <InputLabel for="password_confirmation" value="Confirm Password" />

        <TextInput
          id="password_confirmation"
          type="password"
          class="mt-1 block w-full"
          v-model="form.password_confirmation"
          required
          autocomplete="new-password"
        />

        <InputError class="mt-2" :message="form.errors.password_confirmation" />
      </div>

      <div class="flex items-center justify-end mt-4">
        <Link
          :href="route('login')"
          class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
          既に登録済みですか？
        </Link>

        <PrimaryButton
          class="ml-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          新規登録
        </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>

<style lang="scss">
.line-login-button {
  width: 150px;
  margin: 0 auto;

  a {
    position: relative;

    img {
      width: 100%;
    }

    &::after {
      content: "";
      position: absolute;
      inset: 0;
      border-radius: 8px;

      transition: 0.3s;
    }

    &:hover {
      &::after {
        background-color: #00000040;
      }
    }
  }
}
</style>

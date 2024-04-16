<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, InertiaForm, Link, useForm } from '@inertiajs/vue3';
import { ref, Ref } from 'vue';
import { rules } from '@/Composables/validators'
import { LoginForm } from '@/Composables/types'

defineProps<{
    canResetPassword?: boolean;
    status?: string;
}>();

const show: Ref<boolean> = ref(false)

const form: InertiaForm<LoginForm> = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
        },
    });
};
</script>

<template>
  <GuestLayout>

    <Head title="Log in" />

    <div class="h-screen d-flex justify-center ">
      <v-sheet class="d-flex flex-column justify-center my-auto pa-5" height="500" width="700" rounded>
        <div class="text-h4 text-center text-uppercase mt-5">Login</div>

        <v-form @submit.prevent="submit">
          <v-row class="pa-4 mt-3">
            <v-col
              class="mx-auto"
              cols="12"
              md="8"
            >
              <div class="mx-auto mb-5">
                <v-text-field
                  v-model="form.email"
                  :rules="rules.emailRules"
                  :error-messages="form.errors.email"
                  label="Email"
                  variant="underlined"
                  base-color="" 
                  color=""
                />
              </div>

              <div class=" mx-auto">
                <v-text-field
                  v-model="form.password"
                  :rules="rules.passwordRules"
                  :error-messages="form.errors.password"
                  autocomplete
                  label="Password"
                  variant="underlined"
                  base-color="" 
                  color=""
                  :append-inner-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                  :type="show ? 'text' : 'password'"
                  @click:append-inner="show = !show"
                />
              </div>

              <div class=" mx-auto">
                <v-checkbox
                  v-model="form.remember"
                  label="Remember me"
                />
              </div>
              <div class="mx-auto text-center">
                  <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                  >
                    Forgot your password?
                  </Link>
              </div>
              <div class="mx-auto text-center">
                  <Link
                    :href="route('register')"
                  >
                    Don't have an account? Register.
                  </Link>
              </div>
              <div class=" mx-auto d-flex mt-8">
                <v-btn
                  type="submit"
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                  class="mx-auto"
                  variant="tonal"
                  color=""
                >
                  Login
                </v-btn>
              </div>
            </v-col>
          </v-row>
        </v-form>
      </v-sheet>
    </div>
  </GuestLayout>
</template>
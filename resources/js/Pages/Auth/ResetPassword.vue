<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, InertiaForm, useForm } from '@inertiajs/vue3';
import { rules } from '@/Composables/validators'
import { computed, Ref, ref } from 'vue';
import { ResetPasswordForm } from '@/Composables/types';

const show1: Ref<boolean> = ref(false);
const show2: Ref<boolean> = ref(false);

const props = defineProps<{
    email: string;
    token: string;
}>();

const form: InertiaForm<ResetPasswordForm> = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};

const passwordConfirationRule = computed(() => {
  return form.password_confirmation === form.password || 'Password must match'
})

</script>

<template>
  <GuestLayout>
    <Head title="Reset Password" />

    <div class="h-screen d-flex justify-center ">
      <v-sheet class="d-flex flex-column justify-center my-auto pa-5" height="500" width="700" rounded>
        <div class="text-h4 text-center text-uppercase mt-5">Reset Password</div>
        <v-form @submit.prevent="submit">
          <v-row class="pa-4 mt-3">
            <v-col
              class="mx-auto"
              cols="12"
              md="8"
            >
              <div class="mx-auto">
                <v-text-field
                  v-model="form.email"
                  :rules="rules.emailRules"
                  :error-messages="form.errors.email"
                  label="Email"
                  variant="underlined"
                  base-color="" color=""
                />
              </div>

              <div class="mx-auto">
                <v-text-field
                  v-model="form.password"
                  :rules="rules.passwordRules"
                  :error-messages="form.errors.password"
                  label="Password"
                  variant="underlined"
                  base-color="" color=""
                  :append-inner-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                  :type="show1 ? 'text' : 'password'"
                  @click:append-inner="show1 = !show1"
                />
              </div>

              <div class="mx-auto">
                <v-text-field
                  v-model="form.password_confirmation"
                  :rules="[passwordConfirationRule]"
                  :error-messages="form.errors.password_confirmation"
                  label="Password confirmation"
                  variant="underlined"
                  base-color="" color=""
                  :append-inner-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
                  :type="show2 ? 'text' : 'password'"
                  @click:append-inner="show2 = !show2"
                />
              </div>

              <div class="mx-auto d-flex mt-8">
                <v-btn
                  type="submit"
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                  class="mx-auto"
                  variant="tonal"
                  color=""
                >
                  Reset Password
                </v-btn>
              </div>
            </v-col>
          </v-row>
        </v-form>
      </v-sheet>
    </div>
  </GuestLayout>
</template>
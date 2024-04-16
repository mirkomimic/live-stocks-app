<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, InertiaForm, useForm } from '@inertiajs/vue3';
import { rules } from '@/Composables/validators'
import { Ref, ref } from 'vue';

const show: Ref<boolean> = ref(false);

const form: InertiaForm<{password: string}> = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => {
            form.reset();
        },
    });
};
</script>

<template>
  <GuestLayout>
    <Head title="Confirm Password" />

    <div class="mb-4 text-sm text-gray-600">
        This is a secure area of the application. Please confirm your password before continuing.
    </div>

    <div class="h-screen d-flex justify-center ">
      <v-sheet class="d-flex flex-column justify-center my-auto pa-5" height="500" width="700" rounded>

        <div class="mb-4 text-sm text-gray-600">
          This is a secure area of the application. Please confirm your password before continuing.
        </div>

        <v-form @submit.prevent="submit">
          <v-row class="pa-4 mt-3">
            <v-col
              class="mx-auto"
              cols="12"
              md="8"
            >
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

              <div class=" mx-auto d-flex mt-8">
                <v-btn
                  type="submit"
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                  class="mx-auto"
                  variant="tonal"
                  color=""
                >
                  Confirm
                </v-btn>
              </div>
            </v-col>
          </v-row>
        </v-form>
      </v-sheet>
    </div>
  </GuestLayout>
</template>
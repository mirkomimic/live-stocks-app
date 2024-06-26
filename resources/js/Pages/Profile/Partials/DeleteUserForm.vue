<script setup lang="ts">
import { InertiaForm, useForm } from '@inertiajs/vue3';
import { ref, Ref } from 'vue';
import { rules } from '@/Composables/validators'

const passwordInput = ref<HTMLInputElement | null>(null);
const dialogOpen: Ref<boolean> = ref(false)

const form: InertiaForm<{password: string}> = useForm({
  password: '',
});

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value?.focus(),
        onFinish: () => {
            form.reset();
        },
    });
};

const closeModal = () => {
    dialogOpen.value = false

    form.reset();
};
</script>

<template>
  <v-col
    cols="12"
    md="9"
    class="mx-auto"
  >
    <v-card
      class="mx-auto"
    >
      <v-card-title class="pb-0">
        Delete Account
      </v-card-title>
      <v-card-subtitle class="mb-3">
        Once your account is deleted, all of its resources and data will be permanently deleted.<br> Before deleting your account, please download any data or information that you wish to retain.
      </v-card-subtitle>
      <v-card-actions class="ms-1">
        <!-- <v-btn @click="confirmUserDeletion">Delete Account</v-btn> -->
        <v-dialog width="700" v-model="dialogOpen">
          <template v-slot:activator="{ props }">
            <v-btn v-bind="props" color="red-lighten-3" variant="tonal" text="Delete Account"> </v-btn>
          </template>
          <v-card title="Are you sure you want to delete your account?">
            <v-card-subtitle class="ms-2">
              Once your account is deleted, all of its resources and data will be permanently deleted. <br> Please enter your password to confirm you would like to permanently delete your account.
            </v-card-subtitle>
            <v-card-text>
              <div class="mb-2">
                <v-text-field
                  v-model="form.password"
                  :rules="rules.passwordRules"
                  :error-messages="form.errors.password"
                  ref="passwordInput"
                  type="password"
                  label="Password"
                  variant="solo-filled"
                  base-color="teal-lighten-3" color="teal-lighten-3"
                  class="vuetifySelect"
                />
              </div>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                @click="deleteUser"
                :disabled="form.processing"
                text="Delete Account"
                color="red-lighten-2"
                variant="tonal"
              ></v-btn>
              <v-btn
                @click="dialogOpen = false"
                text="Close Dialog"
                color="teal-lighten-3"
              ></v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-card-actions>
    </v-card>
  </v-col>
</template>
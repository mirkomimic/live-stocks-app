const rules = {
  required: (value: string) => {
    if (value) return true

    return 'The field is required.'
  },
  price: (value: string) => {
    const regex = /^-?\d{1,3}(?:\.\d{3})*(?:,\d{2})?$/;

    return regex.test(value) || 'Invalid format.'
  },
  fileCount: (value: string) => {
    if (!value || value.length <= 8) {
      return true;
    }
    return 'You can only upload a maximum of 8 files';
  },
  emailRules: [
    (value: string) => {
      if (value) return true

      return 'The email field is required.'
    },
    (value: string) => {
      if (/.+@.+\..+/.test(value)) return true

      return 'The email field must be a valid email address.'
    }
  ],
  passwordRules: [
    (value: string) => {
      if (value) return true

      return 'The password field is required.'
    },
    (value: string) => {
      if (value?.length <= 10) return true
  
      return 'Name must be less than 10 characters.'
    }
  ],
  nameRules: [
    (value: string) => {
      if (value) return true
  
      return 'This field is required.'
    },
    // (value: string) => {
    //   if (value?.length <= 10) return true
  
    //   return 'Name must be less than 10 characters.'
    // },
  ]
}

export {rules}

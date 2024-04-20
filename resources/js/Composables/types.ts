type LoginForm = {
  email: string,
  password: string,
  remember: boolean
}

type RegisterForm = {
  name: string,
  email: string,
  password: string,
  password_confirmation: string
}

type ResetPasswordForm = {
  token: string,
  email: string,
  password: string,
  password_confirmation: string
}

type BreadcrumbsType = {
  title: string,
  disabled: boolean,
  to: string
}

type CoreStocksProps = {
  labels: string[],
  datasets: Array<{
    high: string,
    low: string
  }>
}

type CoreStocksForm = {
  symbol: string,
  year: string,
  month: string,
}

export type { LoginForm, RegisterForm, ResetPasswordForm, BreadcrumbsType, CoreStocksProps, CoreStocksForm };
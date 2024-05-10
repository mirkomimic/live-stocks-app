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

type LineChartProps = {
  labels: string[],
  datasets: Array<{
    high: string,
    low: string
  }>
}

type BarChartProps = {
  labels: string[],
  datasets: Array<{
    reportedEPS: string,
  }>
}

type AlphaVantageFiltersForm = {
  symbol: string,
  year: string,
  month: string,
}

type UserNotification = {
  id: string,
  message: string,
  type: string
}

type intradayProps = {
  x: Date,
  y: string[]
}

type GainersAndLosers = {
  ticker: string,
  price: string,
  change_amount: string,
  change_percentage: string,
  volume: string
}

type TopGainersAndLosers = {
  most_actively_traded: GainersAndLosers[],
  top_gainers: GainersAndLosers[],
  top_losers: GainersAndLosers[]
}


export type { LoginForm, RegisterForm, ResetPasswordForm, BreadcrumbsType, LineChartProps, AlphaVantageFiltersForm, BarChartProps, UserNotification, intradayProps, TopGainersAndLosers };
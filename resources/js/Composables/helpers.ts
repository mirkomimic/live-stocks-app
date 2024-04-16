import { ThemeInstance } from "vuetify"

function toggleBasedOnTheme(theme: ThemeInstance, ifLight: string, ifDark: string) {
  return theme.global.name.value == 'light' ? ifLight : ifDark
}
function toggleTheme (theme: ThemeInstance) {
  theme.global.name.value = theme.global.current.value.dark ? 'light' : 'dark'
}


export {toggleBasedOnTheme, toggleTheme}
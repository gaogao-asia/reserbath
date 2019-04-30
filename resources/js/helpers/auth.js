export function getLocalUser() {
  let userStr = localStorage.getItem("user")

  if(userStr) {
    return JSON.parse(userStr)

  }else if(!userStr){
    userStr = window.User
  }else if (!window.User) {
    userStr = null
  }

  return userStr

}
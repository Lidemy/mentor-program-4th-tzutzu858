function capitalize(str) {
  if (str[0]>='a' && str[0]<='z'){
      var a = str.charCodeAt(0)-32
      var sum = String.fromCharCode(a)
      for(i=1;i<str.length;i++){
      sum+=str[i]
      }
  }else return str
  return sum
}
console.log(capitalize('hello'));
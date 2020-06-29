function join(arr, concatStr) {
  if (arr.length === 0) { 
    return '';
  }
  arrNew=[]
  for(i=0;i<arr.length;i++){
  	if (i<arr.length-1)
  	arrNew+=arr[i]+concatStr
    else arrNew+=arr[i]
  }
  return arrNew
}

function repeat(str, times) {
  arrNew=[]
  for(i=1;i<=times;i++){
     arrNew+=str
  }
  return arrNew
}

console.log(join(['a','b','c'], '!%'));
console.log(repeat('<3', 3));

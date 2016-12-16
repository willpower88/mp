var util = {};

util = {
	reg:{
		chinese:function(str){
			if(typeof(str) == "string" ){
				return str.replace(/[\s\u4e00-\u9fa5]+/g,"");
			}else{
				return "";
			}
		},
		email:function(){
			return /^([a-zA-Z0-9]+[_|\_|\.-]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.\-]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
		},
		mobile:function(){
			return /^1(3|4|5|8)[0-9]{9}$/;
		},
		nameA:function(){//只支持数字、英文、汉字
			return /^[0-9a-zA-Z\u4e00-\u9fa5]+$/;
		},
		nameB:function(){//只支持数字、英文
			return /^[0-9a-zA-Z]+$/;
		}
	},
	str:{
		len:function(str){
			var s = 0, a = str.split('');
			for(var i = 0,l = a.length;i<l;i++){
				if(a[i].charCodeAt(0)<299){
					s++;
				}else{
					s+=2;
				}
			}	
			return s;
		}
	},
	time:{
		getDate:function(n){//获取当前日期前几天或后几天日期
			n ? n = n : n = 0;
			var t = new Date(),
			 y = new Date(t.getFullYear(),t.getMonth(),t.getDate()+n),
			M = (y.getMonth()+1 > 9) ? y.getMonth()+1 : '0'+(y.getMonth()+1),
			d = (y.getDate() >9) ? y.getDate() : '0'+y.getDate()
			return y.getFullYear() +'-'+ M + '-' + d; 
		}	

	}
}

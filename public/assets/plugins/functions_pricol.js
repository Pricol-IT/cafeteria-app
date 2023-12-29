//defined url
const API_URL = "https://myapp.pricol.co.in/mypricolapi/CO/";
//const API_URL = "http://113.193.22.82/mypricolapi/PCS/";
//const WEB_URL="http://localhost/balu/html/pricol/dev";
//Dev Url
//const WEB_URL = "http://dev.agtindia.co.in/pricol"; 
//const WEB_URL="http://113.193.22.82/pricol";
const WEB_URL="http://localhost";

//get url path
var pathname = window.location.href;
var pageURL = pathname.replace(WEB_URL, "");

//console.log(pageURL);
//console.log(localStorage.getItem("logged_in"));

/*
//check user login or not
if (
  localStorage.getItem("logged_in") === null ||
  localStorage.getItem("logged_in") === false
) {
  if (pageURL != "/index.html") {
    window.location.replace("index.html");
  }
} else {
  //if user login and go to index page redirect to home page
  if (pageURL == "/index.html") {
    window.location.replace("dashboard.html");
  }
  //if user login and go to index page redirect to home page
  if (pageURL == "/") {
    window.location.replace("dashboard.html");
  }
}

*/


//login function
function login() {

  //define variables
  var loginUsername = $("#loginUsername").val();
  var loginPassword = $("#loginPassword").val();

  //username password empty validation
  if (loginUsername == "" || loginPassword == "") {
    alert("You are not a valid user");
    return false;
  }

  var formData = {
    userid: loginUsername,
    password: loginPassword,
  };

    $("#overlay").fadeIn(300);
  $.ajax({
    type: "GET",
    url: API_URL + "validateUserByUserId",
    data: formData,
    dataType: "json",
  }).done(function (data) {
    console.log(data);
    $("#overlay").fadeOut(3000);

    if (data.Result == null) {
        alert("You are not a valid user");
        $("#overlay").fadeOut(3000);
        window.location.replace("Index.aspx");
        return false;
    }
    if (data.Result == "Failed") {
        alert("You are not a valid user");
        $("#overlay").fadeOut(3000);
        window.location.replace("Index.aspx");
      return false;
    }

    //set login session
     
    console.log(data.Data[0]);
    // return false;
    var UserDetails = [];
      UserDetails = data.Data[0];
      //localStorage.clear();
    localStorage.setItem("logged_in", true);
    localStorage.setItem("UserDetails", JSON.stringify(UserDetails));
    localStorage.setItem("UserId", data.Data[0].UserId);
    localStorage.setItem("EmployeeId", data.Data[0].EmployeeId);-
    localStorage.setItem("plantCode", data.Data[0].PlantCode);
    localStorage.setItem("employeeImage", data.Data[0].EmpImageURL);
    localStorage.setItem("comp_code", data.Cookie.GroupCompanyCode);

    //windowOpen(loginUsername, loginPassword); // added by Ramanan
    
    
    //set cookies

    //  Cookies.set("Domain", data.Cookie.Domain, {
    //  domain: ".113.193.22.82",
    //  expires: 1,
    //  path: "/",
    //});
     

	/*
    //Cookies.set('Path', data.Cookie.Path,{expires:1,path:"/"});
    Cookies.set("UserName", data.Cookie.UserName, { expires: 1, path: "/" });
    Cookies.set("cv_uid", data.Cookie.cv_id, { expires: 1, path: "/" });
    Cookies.set("CompanyCode", data.Cookie.CompanyCode, {
      expires: 1,
      path: "/",
    }); 
    Cookies.set("GroupCompanyCode", data.Cookie.GroupCompanyCode, {
      expires: 1,
      path: "/",
    });
*/
/*
    var pep_cookData = {
      cmpid: data.Cookie.GroupCompanyCode,
      empcode: data.Cookie.UserName,
    };
	*/

	//var pep_cookData = "cmpid=" + data.Cookie.GroupCompanyCode + "&empcode=" + data.Cookie.UserName;
 //   Cookies.set("pep_cook", pep_cookData, { expires: 1, path: "/" });
	
    //redirect to login
      //window.location.replace("dashboard.html");

        //window.location.replace("dashboard.aspx");

      return true;
  });
}


//login function

/*
function login() {
  //define variables
  var loginUsername = $("#loginUsername").val();
  var loginPassword = $("#loginPassword").val();

  //username password empty validation

  if (loginUsername == "" || loginPassword == "") {
    alert("You are not a valid user");
    return false;
  }

  var formData = {
    userid: loginUsername,
    password: loginPassword,
  };

  $("#overlay").fadeIn(300);


	window.location.replace("dashboard.html");
  }
*/
 
// ************************************** Added by Ramanan

var Window;    

// Function that open the new Window
function windowOpen(userid,password) {
    Window = window.open("https://myportal.pricol.co.in/wrs/loginCheck.jsp?scode="+ userid + "&upass=" + password ,"_blank", "toolbar=no,status=no,menubar=no,scrollbars=no,resizable=no,left=20000, top=10000, width=10, height=10, visible=none");
    setTimeout(windowClose, 3000);

}

                 
// function that Closes the open Window
function windowClose() {
    //window.location.replace("dashboard.html");
    Window.close();
}

 
// ********************************** ended by Ramanan

//logout function
function logout() {
  //remove login session
  localStorage.removeItem("logged_in");
  localStorage.removeItem("UserDetails");
  localStorage.removeItem("UserId");
  localStorage.removeItem("EmployeeId");
  localStorage.removeItem("plantCode");
  localStorage.removeItem("employeeImage");

    //localStorage.clear();
  // Cookies.remove('data');
  //remove login cookies
  Cookies.remove("Domain");
  //  Cookies.remove('Path');
  Cookies.remove("UserName");
  Cookies.remove("cv_uid");
  Cookies.remove("CompanyCode");
  Cookies.remove("GroupCompanyCode");
  Cookies.remove("pep_cook");

  Cookies.remove('pep_new_cook'); // added by Ramanan
  Cookies.remove('pep_new_cook_userid'); // added by Ramanan
  Cookies.remove('pep_new_cook_password'); // added by Ramanan

  //Cookies.remove("token");

  //redirect login
  //window.location.href = "index.aspx";
  window.location.replace("Index.aspx");
}

//get userdetail and assin in menu bar
function getUserDetails() {
  var userdetail = JSON.parse(localStorage.getItem("UserDetails"));

  $("#username-text").html(userdetail["UserName"]);

  var userdetailBox =
    "<h6>" +
    userdetail["UserName"] +
    "</h6><span>" +
    userdetail["UserId"] +
    "</span>";

  $("#userdetail-box").html(userdetailBox);

  var userProfile =
    '<img src="' +
    userdetail["EmpImageURL"] +
    '" alt="Profile" class="rounded-circle" />';

  $("#user-profile").html(userProfile);
}

//get application list based on login user
function getAjaxApplications() {
  console.log(localStorage.getItem("UserId"));
  console.log(API_URL + "getApplictionListByUserId");
  var formData = {
    userid: localStorage.getItem("UserId"),
  };

  var applications;
  $.ajax({
    type: "GET",
    url: API_URL + "getApplictionListByUserId",
    data: formData,
    dataType: "json",
    async: false,
    success: function (data, textStatus, jqXHR) {
      console.log(data.Data);
      applications = data.Data;
    },
  });

  return applications;
}

//get application list based on login user
function getApplicationList() {
  var applictionlist = getAjaxApplications();
  var applictionDiv = "";
  var dataLength = applictionlist.length;
  for (i = 0; i < dataLength; i++) {
    applictionDiv +=
      '<div class="swiper-slide" style="width: 123.375px; margin-right: 10px" role="group" aria-label="1 / 8"><a href="' +
      applictionlist[i].URL +
      '" target="_blank"><div class="app-icon" ><img src="./assets/images/glob.png" alt="" class="imgfluid"/></div><div class="app-name"><p>' +
	  // applictionlist[i].URL +
      //'" target="_blank"><div class="app-icon" ><img src="'+ applictionlist[i].ImageURL + '" alt="" class="imgfluid"/></div><div class="app-name"><p>' +
      applictionlist[i].ApplicationName +
      "</p></div></a></div>";
  }

  $("#applicationList").html(applictionDiv);

  applicationSwiper();
}

//get Daily Thoughts
function getDailyThoughts() {
  var formData = {
    userid: localStorage.getItem("UserId"),
  };
  $.ajax({
    type: "GET",
    url: API_URL + "GetDailyThoughtList",
    data: formData,
    dataType: "json",
    async: false,
    success: function (data, textStatus, jqXHR) {
      var DailyThoughtContent =
        " <h4>" +
        data.Data[0].Quote +
        '</h4><p class="shared-by-details"> <span>Thought shared by</span> <br> - ' +
        data.Data[0].Name +
        " | " +
        data.Data[0].Department +
        "</p>";
      $("#daily-thought-content").html(DailyThoughtContent);

      {
        /* <p class="author-name"> - '+data.Data[0].Author+'</p> */
      }
    },
  });
}

//get Daily Thoughts
function getPricolNews() {
  var plantCode = localStorage.getItem("plantCode");
  $.ajax({
    type: "GET",
    url: API_URL + "GetPricolNews?plantcode=" + plantCode,
    dataType: "json",
    async: false,
    success: function (data, textStatus, jqXHR) {
      // console.log(data);
      var pricolNewsContent =
        "<p>" +
        data.Data[0].Announcements +
        '</p><p>18th Dec 2022</p><a href="' +
        data.Data[0].ftpURL +
        '"  target="_blank"><i class="fa fa-angle-right"></i></a><a href="http://113.193.22.82/MyPricol/HRD/Announcements/PricolNewsViewMore" class="read-more" target="_blank">View More</a>';
      $("#pricol-news-content").html(pricolNewsContent);
    },
  });
}

//get Announcement list
function getAjaxAnnouncements() {
  var plantCode = localStorage.getItem("plantCode");
  var announcements;
  $.ajax({
    type: "GET",
    url: API_URL + "GetOrgAnnouncement?plantcode=" + plantCode,
    dataType: "json",
    async: false,
    success: function (data, textStatus, jqXHR) {
      // console.log(data.Data);
      announcements = data.Data;
    },
  });

  return announcements;
}

//get application list based on login user
function getAnnouncementList() {
  var announcementList = getAjaxAnnouncements();

  var announcementDiv = "";
  var dataLength = announcementList.length;

  for (i = 0; i < dataLength; i++) {
    announcementDiv +=
      '<div class="swiper-slide"><h5>' +
      announcementList[i].Announcements +
      '</h5><a href="' +
      announcementList[i].ftpURL +
      '" target="_blank"><i class="fa fa-angle-right"></i></a><a href="http://113.193.22.82/MyPricol/HRD/Announcements/OrganizationViewMore" target="_blank" class="read-more" >View More</a></p></div>';
  }

  //console.log(announcementDiv);
  $("#announcement-list").html(announcementDiv);
  announcementSwiper();
}

//get Weather Details
function getWeather() {
  if ("geolocation" in navigator) {
    //check Geolocation available
    //things to do
    console.log("Geolocation is available!");
    console.log(navigator);
    navigator.geolocation.getCurrentPosition(function (position) {
      console.log(
        "Found your location \nLat : " +
          position.coords.latitude +
          " \nLang :" +
          position.coords.longitude
      );
      //url: "https://api.openweathermap.org/data/2.5/weather?lat=11.0168&lon=76.9558&appid=242453f1f6a9343015e67c10a1eeac62&units=metric",
      $.ajax({
        type: "GET",
        url:
          "https://api.openweathermap.org/data/2.5/weather?lat=" +
          position.coords.latitude +
          "&lon=" +
          position.coords.longitude +
          "=242453f1f6a9343015e67c10a1eeac62&units=metric",
        dataType: "json",
        async: false,
        success: function (data, textStatus, jqXHR) {
          //console.log(data);
         //var temp = data.main.temp;
        var temp = data.main.feels_like;
          var weatherClimate =
            data.weather[0].main + " - " + data.weather[0].description;
          $("#weather-climate").html(weatherClimate);
          var weatherDetails =
            String(temp).slice(0, 2) +
            ' &#8451; <span style="display:none;"><img src="https://openweathermap.org/img/wn/' +
            data.weather[0].icon +
            '@2x.png" alt="" class="img-fluid" style="height:75px;" ></span>';
          $("#weather-details").html(weatherDetails);		  
          console.log('location :'+ data.name);
          var weatherLocation = data.name;
          $("#weather-location").html(weatherLocation);
        },
      });
    });
  } else {
    console.log("Geolocation not available!");
  }
}

//get Quick Link list based on login user
function getAjaxQucikLink() {
  var plantCode = localStorage.getItem("plantCode");

  var quickLinks;
  $.ajax({
    type: "GET",
    url: API_URL + "GetQuickLInks?plantcode=" + plantCode,
    dataType: "json",
    async: false,
    success: function (data, textStatus, jqXHR) {
      // console.log(data.Data);
      quickLinks = data.Data;
    },
  });

  return quickLinks;
}

//get Quick Link list based on login user
function getQuickLinkList() {
  var quickLinkList = getAjaxQucikLink();
  var qucikLinkDiv = "";
  var dataLength = quickLinkList.length;
  for (i = 0; i < dataLength; i++) {
    qucikLinkDiv +=
      '<li><a href="' +
      quickLinkList[i].ftpURL +
      '" target="_blank">' +
      quickLinkList[i].Announcements +
      "</a></li>";
  }

  $("#quickLinkList").html(qucikLinkDiv);
}

//get birthday list
function getAjaxBirthDays() {
	
  var comp_code = localStorage.getItem("comp_code");
  var birthdays;
  $.ajax({
    type: "GET",
    url: API_URL + "GetBirthdayList?compcode=" + comp_code,
    dataType: "json",
    async: false,
    success: function (data, textStatus, jqXHR) {
      //console.log(data.Data);
      birthdays = data.Data;
    },
  });

  return birthdays;
}

//get application list based on login user
function getBirthDayList() {
  var birthDayList = getAjaxBirthDays();

  var birthDayDiv = "";
  var dataLength = birthDayList.length;

  for (i = 0; i < dataLength; i++) {
    birthDayDiv +=
      '<div class="swiper-slide"><div class="inner-birth"><div class="row"><aside class="col-md-3 birth-img"><img src="' +
      birthDayList[i].ImageURL +
      '" alt="" class="img-fluid"></aside><aside class="col-md-9 birth-cont"><h5>' +
      birthDayList[i].EmployeeName +
      '</h5><p>" ' +
      birthDayList[i].DepartmentCode +
          '"</p></aside></div><div class="like-com" style="display:none;"><div class="row"><aside class="col-md-4"><i class="fa fa-thumbs-up"><span>66</span></i></aside><aside class="col-md-6"><span>36 Comments</span></aside><form><input type="text" id="comment"><input type="button" id="postComment" value="post"></form>' +
          '< div class="birthday-2 mt-3" > <aside class=" birth-img"><img src="https://myportal.pricol.co.in/wrs/images/Nodue/E102473.jpg" alt="" class="img-fluid" style="width: 40px;height: 40px;"></aside><aside class="birth-cont"><h5>Babu D</h5><p>Happy Birthday Brother</p></aside></div></div ></div ></div ></div > ';
  }

  $("#birthdayList").html(birthDayDiv);
  birthdaySwiper();
}

//get newJoiner list
function getAjaxNewJoiners() {
  var comp_code = localStorage.getItem("comp_code");
  var newJoiners;
  $.ajax({
    type: "GET",
    url: API_URL + "GetNewJoinersList?compcode=" + comp_code,
    dataType: "json",
    async: false,
    success: function (data, textStatus, jqXHR) {
      //  console.log(data.Data);
      newJoiners = data.Data;
    },
  });

  return newJoiners;
}

//get new joiner list list based on login user
function getNewJoinerList() {
  var newJoinerList = getAjaxNewJoiners();

  var newJoinerDiv = "";
  var dataLength = newJoinerList.length;

  for (i = 0; i < dataLength; i++) {
    var formatedDate = DateFormat(newJoinerList[i].DOJ);

    newJoinerDiv +=
      '<div class="swiper-slide"><div class="inner-birth"><div class="row"><aside class="col-md-3 birth-img"><img src="' +
      newJoinerList[i].ImageURL +
      '" alt="" class="img-fluid"></aside><aside class="col-md-9 birth-cont"><h5>' +
      newJoinerList[i].EmployeeName +
      "</h5><p>" +
      newJoinerList[i].DepartmentCode +
      "  |  " +
      formatedDate +
      "</p></aside></div></div></div>";
  }

  $("#newJoinerList").html(newJoinerDiv);

  newJoinerSwiper();
}

//get Holidays
function getAjaxHolidays() {
  var plantCode = localStorage.getItem("plantCode");

  var holiDays;
  $.ajax({
    type: "GET",
    url: API_URL + "GetListOfHolidays?plantcode=" + plantCode,
    dataType: "json",
    async: false,
    success: function (data, textStatus, jqXHR) {
      console.log(data.Data);
      holiDays = data.Data;
    },
  });

  return holiDays;
}

//get Holiday list
function getHoliDaysList() {
  var holiDayList = getAjaxHolidays();
  var holiDays = [];
  var dataLength = holiDayList.length;
  for (i = 0; i < dataLength; i++) {
    holiDays.push({
      startDate: holiDayList[i].HolidayDate,
      endDate: holiDayList[i].HolidayDate,
      summary: holiDayList[i].Description,
    });
  }
  return holiDays;
}

//date Format
function DateFormat(passDate) {
  var d = new Date(passDate),
    month = "" + (d.getMonth() + 1),
    day = "" + d.getDate(),
    year = d.getFullYear();

  if (month.length < 2) month = "0" + month;
  if (day.length < 2) day = "0" + day;

  const monthNames = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];

  return day + " - " + monthNames[d.getMonth()];
}

//application Swiper
function applicationSwiper() {
  new Swiper(".menuSwiper", {
    slidesPerView: 4,
    spaceBetween: 20,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    scrollbar: {
      el: ".swiper-scrollbar",
      hide: false,
    },
    breakpoints: {
      640: {
        slidesPerView: 5,
        spaceBetween: 30,
      },
      768: {
        slidesPerView: 6,
        spaceBetween: 30,
      },
      1024: {
        slidesPerView: 6,
        spaceBetween: 30,
      },
      1400: {
        slidesPerView: 8,
        spaceBetween: 30,
      },
    },
  });
}

//announcement swiper
function announcementSwiper() {
  new Swiper(".circularSwiper", {
    spaceBetween: 10,
    slidesPerView: 1,
    centeredSlides: true,
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".circular-swiper-pagination",
      clickable: true,
    },

    breakpoints: {
      640: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      768: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      1024: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      1400: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
    },
  });
}

//birthday swiper
function birthdaySwiper() {
  new Swiper(".birthSwiper", {
    slidesPerView: 1,
    spaceBetween: 10,
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".birthday-swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      640: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      768: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      1024: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
    },
  });
}

//new joiner Swiper
function newJoinerSwiper() {
  new Swiper(".newJoinerSwiper", {
    slidesPerView: 1,
    spaceBetween: 10,
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".joiner-swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      640: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      768: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      1024: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
    },
  });
}


//stock price
function getStockprice() {

  $.getJSON('https://query1.finance.yahoo.com/v11/finance/quoteSummary/PRICOLLTD.NS?modules=financialData', function(json_data){
//alert(JSON.stringify(json_data));
console.log(json_data);
});

}

//get exchange rate
function getExchangeRate(base) {
 //console.log(base);
$.getJSON('https://api.exchangerate.host/latest?base='+base+'&symbols=INR&places=4', function(json_data){
  //alert(JSON.stringify(json_data));
  //console.log(json_data);
  //console.log(json_data.rates.INR);
  $("#exchangerate").val(json_data.rates.INR);
  });


}
 
 

  

$(document).ready(function () {
  AOS.init();
  setCredits("#37788d", "ino");
  $(".bannerSlider").bxSlider({
    controls: false,
  });
  $(".gallery div").bxSlider({
    controls: false,
  });
  if (!document.querySelector(".tabs")) {
    $("#preloader").fadeOut("fast");
  }

  $(".wait").click(function () {
    $("#preloader").fadeIn("fast");
  });

  if ($("#playvideo").length > 0) {
    $("#playvideo").click(function () {
      $("#playvideo").fadeOut("fast");
      var vid = document.getElementById("videoplayer");
      vid.play();
    });
    $("#overlay").click(function () {
      $("#playvideo").fadeIn("fast");
      var vid = document.getElementById("videoplayer");
      vid.pause();
    });
  }
  if (document.querySelector(".checkout .card-list ul")) {
    updateList();
  }
});
if (document.querySelector("#checkoutform")) {
  $("#checkoutform").validate({
    ignore: "",
    rules: {},
    messages: {},
    submitHandler: function (form) {
      $("#checkoutform button").attr("disabled", true);
      $("#checkoutform button").text("Enviando");
      $("#checkoutform").ajaxSubmit({
        dataType: "json",
        success: function (data) {
          for (let i = 0; i < cartItems.length; i++) {
            let message = `Hola Doctor soy ${
              document.querySelector("#checkoutform input#name").value
            } estoy en pais y viajo a colombia aproximadamente el ${
              document.querySelector("#checkoutform input#date").value
            } estoy interesada/o en una valoracion virtual de ${
              cartItems[i].doctor.acf.especialidad
            }, para realizarme estos procedimientos ${cartItems[i].title}`;
            let templateDoctor = `<li class="flex"><img src="${cartItems[i].doctor.acf.foto}"><div><h2 class="bold" style="margin-bottom:20px;">${cartItems[i].doctor.title.rendered}</h2><a href="https://api.whatsapp.com/send?phone=${cartItems[i].doctor.acf.whatsapp}&text=${message}%20%F0%9F%91%A8%E2%80%8D%E2%9A%95%EF%B8%8F%F0%9F%91%A9%E2%80%8D%E2%9A%95%EF%B8%8F%F0%9F%A9%BA%EF%B8%8F" target="_BLANK" class="button whatsapp">Escribe por whatsapp</a></div></li>`;
            document.querySelector(".thanks .card-list ul").innerHTML +=
              templateDoctor;
          }
          $(".thanks").hide();
          document.querySelector(".section-title1").innerHTML =
            "Estos son los profesionales que estarán a cargo de tu valoración, puedes contactarlos directamente por WhatsApp y te atenderán en el menor tiempo posible";
          $(".checkout").hide();
          $(".thanks").fadeIn("fast");
        },
      });

      return false;
    },
  });
}

const cart = document.querySelector("#cart");
const cartItemsList = document.querySelector("#cart-items");

let cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];

function removeItem(itemIndex) {
  cartItems.splice(itemIndex, 1);
  localStorage.setItem("cartItems", JSON.stringify(cartItems));
  updateCart();
}

document.querySelector(
  "header .first-level.right-menu .pres a span"
).innerHTML = cartItems.length;

function updateCart() {
  let itemsListHTML = "";
  for (let i = 0; i < cartItems.length; i++) {
    itemsListHTML += `<li><img src="${cartItems[i].img}" alt="${cartItems[i].title}" />${cartItems[i].title}<button type="button" class="remove-cart" onclick="removeItem(${i})"><img src="img/delete.svg" alt="remove" /></button></li>`;
  }
  cartItemsList.innerHTML = itemsListHTML;

  if (cartItems.length > 0) {
    cart.classList.add("active");
  } else {
    cart.classList.remove("active");
  }
  document.querySelector(
    "header .first-level.right-menu .pres a span"
  ).innerHTML = cartItems.length;
}

function openCart() {
  cart.classList.toggle("active");
}

let itemsListHTML = "";
for (let i = 0; i < cartItems.length; i++) {
  itemsListHTML += `<li><img src="${cartItems[i].img}" alt="${cartItems[i].title}" />${cartItems[i].title}<button type="button" class="remove-cart" onclick="removeItem(${i})"><img src="img/delete.svg" alt="remove" /></button></li>`;
}
cartItemsList.innerHTML = itemsListHTML;

function updateList() {
  document.querySelector(".checkout .card-list ul").innerHTML = "";
  document.querySelector(".thanks .card-list ul").innerHTML = "";
  document.querySelector("#procedimientos").value = cartItems
    .map((item) => item.id)
    .toString();
  for (let i = 0; i < cartItems.length; i++) {
    let template = `<li class="flex"><img src="${cartItems[i].img}"><div><h2 class="bold">${cartItems[i].title}</h2></div></li>`;
    document.querySelector(".checkout .card-list ul").innerHTML += template;
  }
}
if (document.querySelector(".tabs")) {
  const tabs = document.querySelector(".tabs");
  const tabList = tabs.querySelector(".tab-list");
  const tabItems = tabList.querySelectorAll(".tab-item");
  const tabContents = tabs.querySelectorAll(".tab-pane");
  if (tabs) {
    tabList.addEventListener("click", (e) => {
      if (e.target.classList.contains("tab-item")) {
        const dataTab = e.target.getAttribute("data-tab");
        tabItems.forEach((item) => {
          item.classList.remove("active");
        });
        e.target.classList.add("active");
        tabContents.forEach((content) => {
          content.classList.remove("active");
        });
        tabs.querySelector(`#${dataTab}`).classList.add("active");
      }
    });
  }
}

const toggleBtn = document.getElementById("menu-toggle");

toggleBtn.addEventListener("click", function () {
  this.classList.toggle("active");
  document.querySelector("header.mobile nav").classList.toggle("active");
});

const addToCartButtons = document.querySelectorAll(".add-to-cart");

addToCartButtons.forEach((addToCartButton) => {
  addToCartButton.addEventListener("click", function () {
    const newItem = {
      id: addToCartButton.dataset.id,
      title: addToCartButton.dataset.title,
      img: addToCartButton.dataset.img,
      doctor: JSON.parse(addToCartButton.dataset.doctor),
    };

    const existingItem = cartItems.find(function (item) {
      return item.id === newItem.id;
    });

    if (!existingItem) {
      cartItems.push(newItem);
    }
    localStorage.setItem("cartItems", JSON.stringify(cartItems));
    updateCart();
  });
});

if (document.querySelector(".tabs")) {
  function getServices() {
    if (
      document.querySelector(
        ".tab-content .tab-pane.active details[open] .grid"
      ).innerHTML == ""
    ) {
      $("#preloader").fadeIn("fast");
      document
        .querySelectorAll(".tab-content .tab-pane.active details[open]")
        .forEach((details) => {
          let services = JSON.parse(details.dataset.services);
          let urls = [];
          services.forEach((service) => {
            urls.push(`get/services.php?id=${service}`);
          });
          const fetchServicesData = () => {
            const allRequests = urls.map(async (url) => {
              let response = await fetch(url);
              return response.json();
            });
            return Promise.all(allRequests);
          };
          fetchServicesData()
            .then((arrayOfResponses) => {
              arrayOfResponses.forEach((procedimientoData) => {
                let template = `<a href="service.php?id=${procedimientoData.id}" class="wait"><img src="${procedimientoData.acf.imagen_cuadrada_para_el_listado}" alt="${procedimientoData.title.rendered}"/><span class="bold uppercase">${procedimientoData.title.rendered}</span></a>`;
                document.querySelector(
                  ".tab-content .tab-pane.active details[open] .grid"
                ).innerHTML += template;
              });
            })
            .then(() => $("#preloader").fadeOut("slow"));
        });
    } else {
      $("#preloader").fadeOut("slow");
    }
  }
  getServices();
  document
    .querySelectorAll(".tab-content details summary")
    .forEach((detail) => {
      detail.addEventListener("click", (e) => {
        document
          .querySelector(".tab-content details[open]")
          .removeAttribute("open");
        setTimeout(getServices, 100);
      });
    });
  document.querySelectorAll(".tab-item").forEach((tab) => {
    tab.addEventListener("click", (e) => {
      setTimeout(getServices, 100);
    });
  });
}

const categoryItems = document.querySelectorAll(".categoryItem");

categoryItems.forEach((item) => {
  item.addEventListener("click", () => {
    categoryItems.forEach((i) => {
      i.classList.remove("active");
    });

    item.classList.add("active");
  });
});

const openModal = document.getElementsByClassName("openModal");
const closeModal = document.getElementById("closeModal");
const modal = document.getElementById("modal");
let qty = 1;
const increaseBtn = document.getElementById("increase-qty-btn");
const decreaseBtn = document.getElementById("decrease-qty-btn");
const quantity = document.getElementById("quantity");

for (let i = 0; i < openModal.length; i++) {
  openModal[i].addEventListener("click", () => {
    modal.classList.add("active");
    const drinksName = openModal[i].dataset.drinksName;
    const drinksImage = openModal[i].dataset.drinksImage;
    const drinksDescription = openModal[i].dataset.drinksDescription;
    const drinksPrice = openModal[i].dataset.drinksPrice;

    document.getElementById("drink-id-input").value =
      openModal[i].dataset.drinksId;
    document.getElementById("drink-name-input").value = drinksName;
    document.getElementById("drink-price-input").value = drinksPrice;
    document.getElementById("drink-image-input").value = drinksImage;
    quantity.textContent = qty;
    document.getElementById("drink-quantity-input").value = qty;

    document.getElementById("modal-drinks-name").textContent = drinksName;
    document.getElementById("modal-drinks-image").src = drinksImage;
    document.getElementById("modal-drinks-description").textContent =
      drinksDescription;
    document.getElementById(
      "modal-drinks-price"
    ).textContent = `RM ${drinksPrice}`;
  });
}

increaseBtn.addEventListener("click", () => {
  qty++;
  quantity.textContent = qty;
  document.getElementById("drink-quantity-input").value = qty;
});

decreaseBtn.addEventListener("click", () => {
  if (qty > 1) {
    qty--;
    quantity.textContent = qty;
    document.getElementById("drink-quantity-input").value = qty;
  }
});

closeModal.addEventListener("click", () => {
  modal.classList.remove("active");
  qty = 1;
  quantity.textContent = qty;
  document.getElementById("drink-quantity-input").value = qty;
});

window.addEventListener("click", (e) => {
  if (e.target === modal) {
    modal.classList.remove("active");
    qty = 1;
    quantity.textContent = qty;
    document.getElementById("drink-quantity-input").value = qty;
  }
});


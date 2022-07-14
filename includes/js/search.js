// search bar function
const searchInput = document.getElementById('search');
const listItems = document.querySelectorAll('.accordion-item');

searchInput.addEventListener('input', () => {
  const filter = searchInput.value.toLowerCase();
  showList();
  const valueExist = !!filter.length;

  if (valueExist) {
    listItems.forEach((el) => {
      const elText = el.firstChild.firstChild.textContent.trim().toLowerCase();
      const isIncluded = elText.includes(filter);
      if (!isIncluded) {
        el.style.display = 'none';
        el.nextElementSibling.style.display = 'none';

      }
    });
  }
});

const showList = () => {
  listItems.forEach((el) => {
    el.style.display = 'block';
    el.nextElementSibling.style.display = 'block';

  });
};

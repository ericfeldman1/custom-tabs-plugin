document.addEventListener('DOMContentLoaded', function () {
  const wrappers = document.querySelectorAll('.ctp-tabs');

  wrappers.forEach(function (wrapper) {
    const tabs = wrapper.querySelectorAll('.tab-button');
    const panels = wrapper.querySelectorAll('.tab-item');

    tabs.forEach(function (tab) {
      tab.addEventListener('click', function () {
        const target = tab.getAttribute('data-tab');

        tabs.forEach(function (t) {
          t.classList.remove('active');
          t.setAttribute('aria-selected', 'false');
        });

        panels.forEach(function (p) {
          p.classList.remove('active');
        });

        tab.classList.add('active');
        tab.setAttribute('aria-selected', 'true');

        const targetPanel = wrapper.querySelector('#' + target);
        if (targetPanel) {
          targetPanel.classList.add('active');
        }
      });
    });
  });
});
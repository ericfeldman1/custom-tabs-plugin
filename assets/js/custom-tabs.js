document.addEventListener('DOMContentLoaded', function () {
  console.log('custom tabs js loaded');

  const wrappers = document.querySelectorAll('.ctp-tabs');
  console.log('wrappers found:', wrappers.length);

  wrappers.forEach(function (wrapper, wrapperIndex) {
    const tabs = wrapper.querySelectorAll('.ctp-tab');
    const panels = wrapper.querySelectorAll('.ctp-panel');

    console.log('wrapper', wrapperIndex, 'tabs:', tabs.length, 'panels:', panels.length);

    tabs.forEach(function (tab) {
      tab.addEventListener('click', function (e) {
  e.preventDefault();
  const target = tab.getAttribute('data-tab');
        console.log('clicked tab target:', target);

        tabs.forEach(function (t) {
          t.classList.remove('is-active');
        });

        panels.forEach(function (p) {
          p.classList.remove('is-active');
        });

        tab.classList.add('is-active');

        const panel = wrapper.querySelector('.ctp-panel[data-panel="' + target + '"]');
        console.log('matched panel:', panel);

        if (panel) {
          panel.classList.add('is-active');
        }
      });
    });
  });
});
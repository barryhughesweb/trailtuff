document.addEventListener("DOMContentLoaded", function () {
  const toggle = document.getElementById("menuToggle");
  const menu = document.getElementById("mobileMenu");
  const panel = document.getElementById("menuPanel");
  const overlay = document.getElementById("menuOverlay");

  const bar1 = document.getElementById("bar1");
  const bar2 = document.getElementById("bar2");
  const bar3 = document.getElementById("bar3");

  function openMenu() {
    menu.classList.remove("hidden");

    setTimeout(() => {
      overlay.classList.remove("opacity-0");
      overlay.classList.add("pointer-events-auto");
      panel.classList.remove("translate-x-full");
    }, 10);

    document.body.classList.add("overflow-hidden");

    bar1.classList.add("rotate-45", "translate-y-2");
    bar2.classList.remove("opacity-100");
    bar2.classList.add("opacity-0");
    bar3.classList.add("-rotate-45", "-translate-y-2");
  }

  function closeMenu() {
    overlay.classList.add("opacity-0");
    overlay.classList.remove("pointer-events-auto");
    panel.classList.add("translate-x-full");

    setTimeout(() => {
      menu.classList.add("hidden");
    }, 300);

    document.body.classList.remove("overflow-hidden");

    bar1.classList.remove("rotate-45", "translate-y-2");
    bar2.classList.add("opacity-100");
    bar2.classList.remove("opacity-0");
    bar3.classList.remove("-rotate-45", "-translate-y-2");
  }

  // Toggle button click
  toggle.addEventListener("click", function () {
    const isHidden = panel.classList.contains("translate-x-full");
    isHidden ? openMenu() : closeMenu();
  });

  // Escape key closes menu
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape" && !panel.classList.contains("translate-x-full")) {
      closeMenu();
    }
  });

  // Overlay click closes menu
  overlay.addEventListener("click", function () {
    closeMenu();
  });

  // Swiper setup
  new Swiper('.happy-swiper', {
    loop: true,
    centeredSlides: true,
    spaceBetween: 20,
    slidesPerView: 1.2,

    breakpoints: {
      640: {
        slidesPerView: 2.2,
      },
      1024: {
        slidesPerView: 3.3,
        spaceBetween: 30,
        centeredSlides: true,
      },
    },

    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },

    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },

    loopedSlides: 100,
  });


  // Countdown timer
  const countdownEl = document.getElementById('countdown');
  if (countdownEl) {
    const targetDateString = countdownEl.dataset.targetDate;
    if (targetDateString) {
      const targetDate = new Date(targetDateString).getTime();

      function updateValue(id, value) {
        const el = document.getElementById(id);
        if (!el) return;

        if (el.textContent != value) {
          el.classList.add('opacity-0', 'transition-opacity', 'duration-200');

          setTimeout(() => {
            el.textContent = value;
            el.classList.remove('opacity-0');
            el.classList.add('opacity-100');
          }, 200);
        }
      }

      const timer = setInterval(() => {
        const now = new Date().getTime();
        const distance = targetDate - now;

        if (distance <= 0) {
          clearInterval(timer);
          countdownEl.innerHTML = "<p class='text-red-600 font-semibold'>Expired</p>";
          return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        updateValue("days", days);
        updateValue("hours", hours);
        updateValue("minutes", minutes);
        updateValue("seconds", seconds);
      }, 1000);
    }
  }
});

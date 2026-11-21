(() => {
  "use strict";
  document.addEventListener("DOMContentLoaded", () => {
    const motion = window.PlateauMotion;
    const track = document.querySelector("[data-story-track]");
    if (!track || !motion || motion.reducedMotion.matches || window.innerWidth < 820) return;
    const panels = [...track.querySelectorAll("[data-story-panel]")];
    if (!panels.length) return;
    let lastActiveIndex = -1;

    function updateStory() {
      const rect = track.getBoundingClientRect();
      const range = Math.max(1, track.offsetHeight - window.innerHeight);
      const progress = Math.max(0, Math.min(1, -rect.top / range));
      const position = progress * panels.length;
      const activeIndex = Math.min(panels.length - 1, Math.floor(position));
      if (activeIndex !== lastActiveIndex) {
        panels.forEach((panel) => panel.querySelector("[data-fly-in]")?.classList.remove("is-flying"));
        if (activeIndex === 1) panels[activeIndex].querySelector("[data-fly-in]")?.classList.add("is-flying");
        lastActiveIndex = activeIndex;
      }
      panels.forEach((panel, index) => {
        const distance = position - index;
        const active = distance >= 0 && distance < 1;
        const entering = distance < 0 && distance > -0.12;
        panel.classList.toggle("is-active", active || entering);
        panel.style.opacity = active ? String(Math.min(1, 0.35 + (1 - Math.abs(distance - 0.35)) * 0.9)) : "0";
        panel.style.transform = `translate3d(0, ${active ? Math.max(0, 28 - distance * 40) : (index < position ? -32 : 36)}px, 0) scale(${active ? 1 : 0.985})`;
        panel.setAttribute("aria-hidden", active ? "false" : "true");
      });
    }
    motion.addFrameTask(updateStory);
    updateStory();
  });
})();

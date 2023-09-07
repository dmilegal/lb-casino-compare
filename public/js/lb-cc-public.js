(function () {
  const notifier = new AWN({
    position: 'bottom-left'
  });

  (function (btns) {
    "use strict";

    if (!btns.length) return;

    btns.forEach((btn) => btn.addEventListener("click", toggleCompare));

    function toggleCompare() {
      try {
        if (this.classList.contains("lb-cc-toggle-btn--add")) {
          addCompareIds([this.dataset.id]);
        } else {
          removeCompareIds([this.dataset.id]);
        }

        this.parentElement
          .querySelector(".lb-cc-toggle-btn:not(.lb-cc-toggle-btn--active)")
          .classList.add("lb-cc-toggle-btn--active");
        this.classList.remove("lb-cc-toggle-btn--active");
      } catch (error) {
        LB_CC_TRANSLATE[error.message] && notifier.warning(LB_CC_TRANSLATE[error.message])
        console.error(error);
      }
    }
  })(document.querySelectorAll(".lb-cc-toggle-btn"));

  function getCurrentCompareIds() {
    const data = document.cookie.split("; ").reduce((acc, item) => {
      const [name, value] = item.split("=");
      acc[name] = value;
      return acc;
    }, {});
    return data[LB_CC_COOKIE_NAME] ? data[LB_CC_COOKIE_NAME].split(",") : [];
  }

  function addCompareIds(ids) {
    let currentIds = getCurrentCompareIds();
    currentIds.push(...ids);
    currentIds = [...new Set(currentIds)];

    if (currentIds.length > LB_CC_LIMIT) throw new Error("MAX_LIMIT");

    document.cookie = `${LB_CC_COOKIE_NAME}=${currentIds.join(",")}`;

    return true;
  }

  /**
   *
   * @param {string[]} ids
   * @returns
   */
  function removeCompareIds(ids) {
    let currentIds = getCurrentCompareIds();
    currentIds = currentIds.filter((id) => ids.indexOf(id) == -1);

    document.cookie = `${LB_CC_COOKIE_NAME}=${currentIds.join(",")}`;

    return true;
  }
})();

/* global Stickyfill */
if (!Array.from) {
  Array.from = (function cb() {
    const toStr = Object.prototype.toString;
    function isCallable(fn) {
      return typeof fn === 'function' || toStr.call(fn) === '[object Function]';
    }
    function toInteger(value) {
      const number = Number(value);
      if (Number.isNaN(number)) {
        return 0;
      }
      if (number === 0 || !Number.isFinite(number)) {
        return number;
      }
      return (number > 0 ? 1 : -1) * Math.floor(Math.abs(number));
    }
    const maxSafeInteger = Math.pow(2, 53) - 1;
    const toLength = function toLength(value) {
      const len = toInteger(value);
      return Math.min(Math.max(len, 0), maxSafeInteger);
    };
    // The length property of the from method is 1.
    return function from(...args /* , mapFn, thisArg */) {
      // 1. Let C be the this value.
      const C = this;
      // 2. Let items be ToObject(arrayLike).
      const items = Object(args);
      // 3. ReturnIfAbrupt(items).
      if (args == null) {
        throw new TypeError('Array.from requires an array-like object - not null or undefined');
      }
      // 4. If mapfn is undefined, then let mapping be false.
      const mapFn = arguments.length > 1 ? args[1] : undefined;
      let T;
      if (typeof mapFn !== 'undefined') {
        // 5. else
        // 5. a If IsCallable(mapfn) is false, throw a TypeError exception.
        if (!isCallable(mapFn)) {
          throw new TypeError('Array.from: when provided, the second argument must be a function');
        }
        // 5. b. If thisArg was supplied, let T be thisArg; else let T be undefined.
        if (arguments.length > 2) {
          [, T] = args;
        }
      }
      // 10. Let lenValue be Get(items, "length").
      // 11. Let len be ToLength(lenValue).
      const len = toLength(items.length);
      // 13. If IsConstructor(C) is true, then
      // 13. a. Let A be the result of calling the [[Construct]] internal method of C with an argument list containing the single item len.
      // 14. a. Else, Let A be ArrayCreate(len).
      const A = isCallable(C) ? Object(new C(len)) : new Array(len);
      // 16. Let k be 0.
      let k = 0;
      // 17. Repeat, while k < len… (also steps a - h)
      let kValue;
      while (k < len) {
        kValue = items[k];
        if (mapFn) {
          A[k] = typeof T === 'undefined' ? mapFn(kValue, k) : mapFn.call(T, kValue, k);
        } else {
          A[k] = kValue;
        }
        k += 1;
      }
      // 18. Let putStatus be Put(A, "length", len, true).
      A.length = len;
      // 20. Return A.
      return A;
    };
  })();
}
(() => {
  // Custom behavior for developer app forms.
  const getBrowserHeight = () => {
    return Number.isNaN(window.innerHeight) ? window.clientHeight : window.innerHeight;
  };
  const bodyElement = document.querySelector('body');
  const wrapElement = (element) => {
    const wrapper = document.createElement('div');
    element.parentNode.insertBefore(wrapper, element);
    wrapper.appendChild(element);
    return wrapper;
  };
  const createSize = (input) => {
    let numeric = 0;
    let unit = 'px';
    if (typeof input === 'string') {
      numeric =
        typeof input.match(/\d+/g) === 'object' && input.match(/\d+/g) ? input.match(/\d+/g)[0] : input.match(/\d+/g);
      unit =
        typeof input.match(/[a-zA-Z]+/g) === 'object' && input.match(/[a-zA-Z]+/g)
          ? input.match(/[a-zA-Z]+/g)[0]
          : input.match(/[a-zA-Z]+/g);
    } else if (typeof input === 'number') {
      numeric = input;
      unit = 'px';
    }
    if (!numeric) {
      numeric = 0;
    }
    if (!unit) {
      unit = 'px';
    }
    return { numeric, unit };
  };
  const getRealBodyHeight = () => {
    return Math.max(
      document.body.scrollHeight,
      document.body.offsetHeight,
      document.querySelector('html').clientHeight,
      document.querySelector('html').scrollHeight,
      document.querySelector('html').offsetHeight,
    );
  };
  class AffixedElement {
    constructor(
      targetElementSelector,
      fixedTopBoundarySelectors,
      bottomBoundarySelectors,
      menuItemSelector = '.ip-navigation-item a',
      isFixed = true,
    ) {
      this.fixedTopBoundary = document.querySelectorAll(fixedTopBoundarySelectors);
      this.bottomBoundary = document.querySelectorAll(bottomBoundarySelectors);
      this.element = document.querySelector(targetElementSelector);
      this.isFixed = isFixed;
      this.isSet = false;
      this.fixedClass = 'is-fixed';
      this.bodyPadding = 0;
      this.limitsSet = false;
      if (this.element) {
        this.wrapper = wrapElement(this.element);
        this.wrapper.classList.add('affix--wrapper');
        this.wrapperTop = this.wrapper.getBoundingClientRect().top + (window.scrollY || window.pageYOffset);
        this.menuItems = this.element.querySelectorAll(menuItemSelector);
        this.elementHeight = getBrowserHeight();
        if (!this.isFixed) {
          this.fixedClass = 'is-sticky';
        } else {
          this.bodyPadding = this.element.clientHeight;
        }
        this.addEvents();
      }
    }

    setStatic() {
      if (!this.isSet) {
        if (typeof Stickyfill !== 'undefined') {
          this.isSet = true;
          Stickyfill.addOne(this.element);
        }
      }
      this.element.classList.add(this.fixedClass);
      this.style = this.element.setAttribute('style', `max-height:${this.elementHeight}px;`);
      if (!this.limitsSet) {
        this.limitsSet = true;
        bodyElement.style.paddingTop =
          parseInt(createSize(bodyElement.style.paddingTop).numeric, 10) +
          parseInt(createSize(this.bodyPadding).numeric, 10) +
          createSize(bodyElement.style.paddingTop).unit;
      }
      this.element.style.top = `${this.constructor.getOffsetSum(this.fixedTopBoundary)}px`;
    }

    unsetStatic() {
      if (this.isSet) {
        this.isSet = false;
      }
      this.element.classList.remove(this.fixedClass);
      if (!this.isFixed) {
        if (typeof Stickyfill !== 'undefined') {
          Stickyfill.removeOne(this.element);
        }
      }
      if (this.limitsSet) {
        this.limitsSet = false;
        bodyElement.style.paddingTop =
          parseInt(createSize(bodyElement.style.paddingTop).numeric, 10) -
          parseInt(createSize(this.bodyPadding).numeric, 10) +
          createSize(bodyElement.style.paddingTop).unit;
      }
      this.element.style.top = 'auto';
    }

    addEvents() {
      window.addEventListener('scroll', this.onScroll.bind(this));
    }

    setStyle = (element, styleType, styleRule) => {
      this[element].style[styleType] = styleRule;
    };

    static getOffsetSum(nodeList) {
      let result = 0;
      [].forEach.call(nodeList, (node) => {
        result += node.clientHeight;
      });
      return result;
    }

    getVisibleBottomHeight() {
      return (
        getBrowserHeight() +
        (window.scrollY || window.pageYOffset) -
        (getRealBodyHeight() - this.constructor.getOffsetSum(this.bottomBoundary))
      );
    }

    getUsefulAreaHeight() {
      return (
        getBrowserHeight() -
        ((this.getVisibleBottomHeight() > 0 ? this.getVisibleBottomHeight() : 0) +
          this.constructor.getOffsetSum(this.fixedTopBoundary))
      );
    }

    onScroll() {
      const windowScrolled = window.scrollY || window.pageYOffset;
      if (windowScrolled + this.constructor.getOffsetSum(this.fixedTopBoundary) > this.wrapperTop) {
        this.setStatic();
      } else {
        this.unsetStatic();
      }
    }
  }
  const affixSettings = [];
  Object.keys(drupalSettings).forEach((setting) => {
    if (setting.indexOf('affix_') > -1) {
      drupalSettings[setting].forEach((affix) => {
        affixSettings.push(affix);
      });
    }
  });
  if (affixSettings.length > 0) {
    affixSettings.forEach((affixElement) => {
      if (Array.from(document.querySelector('body').classList).indexOf('page-node-type-api-reference') > -1) {
        window.addEventListener('swaggerUILoaded', () => {
          // TODO: Must consider transforming the class into a function or how to use it as a proper class.
          // eslint-disable-next-line no-new
          new AffixedElement(...affixElement);
        });
      } else {
        // eslint-disable-next-line no-new
        new AffixedElement(...affixElement);
      }
    });
  }
})();

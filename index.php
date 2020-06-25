<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitter感情分析</title>
    <style>
        html,
        body,
        div,
        span,
        applet,
        object,
        iframe,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        blockquote,
        pre,
        a,
        abbr,
        acronym,
        address,
        big,
        cite,
        code,
        del,
        dfn,
        em,
        img,
        ins,
        kbd,
        q,
        s,
        samp,
        small,
        strike,
        strong,
        sub,
        sup,
        tt,
        var,
        b,
        u,
        i,
        center,
        dl,
        dt,
        dd,
        ol,
        ul,
        li,
        fieldset,
        form,
        label,
        legend,
        table,
        caption,
        tbody,
        tfoot,
        thead,
        tr,
        th,
        td,
        article,
        aside,
        canvas,
        details,
        embed,
        figure,
        figcaption,
        footer,
        header,
        hgroup,
        menu,
        nav,
        output,
        ruby,
        section,
        summary,
        time,
        mark,
        audio,
        video {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }

        article,
        aside,
        details,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        menu,
        nav,
        section {
            display: block;
        }

        body {
            line-height: 1;
        }

        ol,
        ul {
            list-style: none;
        }

        blockquote,
        q {
            quotes: none;
        }

        blockquote:before,
        blockquote:after,
        q:before,
        q:after {
            content: '';
            content: none;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        /* particleground demo */

        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        body {
            background: #0074D9;
            font-family: 'Montserrat', sans-serif;
            color: #fff;
            line-height: 1.3;
            -webkit-font-smoothing: antialiased;
        }

        #particles {
            background: url('http://arnaudel.perso.neuf.fr/Payekhali/Fonds/1280/AS11-40-5873.jpg') top center;
            background-size: cover;
            background-repeat: no-repeat;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        #intro {
            position: absolute;
            left: 0;
            top: 50%;
            padding: 0 20px;
            width: 100%;
            text-align: center;
        }

        .overlay {
            position: fixed;
            background: rgba(0, 0, 0, 0.5);
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: block;
        }

        h1 {
            text-transform: uppercase;
            font-size: 85px;
            font-weight: 700;
            letter-spacing: 0.015em;
        }

        h1::after {
            content: '';
            width: 80px;
            display: block;
            background: #fff;
            height: 10px;
            margin: 30px auto;
            line-height: 1.1;
        }

        p {
            margin: 0 0 30px 0;
            font-size: 24px;
        }

        .btn {
            display: inline-block;
            padding: 15px 30px;
            border: 2px solid #fff;
            text-transform: uppercase;
            letter-spacing: 0.015em;
            font-size: 18px;
            font-weight: 700;
            line-height: 1;
            color: #fff;
            text-decoration: none;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            -o-transition: all 0.4s;
            transition: all 0.4s;
        }

        .btn:hover {
            color: #005544;
            border-color: #005544;
        }

        @media only screen and (max-width: 1000px) {
            h1 {
                font-size: 70px;
            }
        }

        @media only screen and (max-width: 800px) {
            h1 {
                font-size: 48px;
            }

            h1::after {
                height: 8px;
            }
        }

        @media only screen and (max-width: 568px) {
            #intro {
                padding: 0 10px;
            }

            h1 {
                font-size: 30px;
            }

            h1::after {
                height: 6px;
            }

            p {
                font-size: 18px;
            }

            .btn {
                font-size: 16px;
            }
        }

        @media only screen and (max-width: 320px) {
            h1 {
                font-size: 28px;
            }

            h1::after {
                height: 4px;
            }
        }

        select {

            /* ブロックレベル要素化する */
            width: 100px;
            /* ボックスの高さを指定する */
            padding: 10px 15px;
            /* ボックス内側の余白を指定する */
            /* display: flex; */
            /* 子要素をflexboxで揃える */
            flex-direction: column;
            /* 子要素をflexboxにより縦方向に揃える */
            justify-content: center;
            /* 子要素をflexboxにより中央に配置する */
            align-items: center;
            /* 子要素をflexboxにより中央に配置する */

        }
    </style>
</head>

<body>
    <div id="particles">
        <div class="overlay"></div>
        <div id="intro">
            <h1>Twitter<br>感情分析マシン</h1>
            <form action="user_line.php" method="POST">
                <fieldset>
                    <p>TwitterユーザーIDと表示件数を<br>入力してください</p>
                    <select name="user_id">
                        <option value="yohwp022">内藤様</option>
                        <option value="hiro_yas">児玉様</option>
                        <option value="ikuyaprograming">郁也</option>
                        <option value="tommyfun_info">富井様</option>
                        <option value="taro_osg">太郎様</option>
                        <option value="kuu28053816">中村様</option>
                        <option value="dareios__1">ダレイオス</option>
                        <option value="kanakai03">斉藤様</option>
                        <option value="miniusagi33">吉田様</option>
                        <option value="kuroking1023">黒木様</option>
                    </select>
                    <select name="num">
                        <option value="">-</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                        <option value="32">32</option>
                        <option value="33">33</option>
                        <option value="34">34</option>
                        <option value="35">35</option>
                        <option value="36">36</option>
                        <option value="37">37</option>
                        <option value="38">38</option>
                        <option value="39">39</option>
                        <option value="40">40</option>
                        <option value="41">41</option>
                        <option value="42">42</option>
                        <option value="43">43</option>
                        <option value="44">44</option>
                        <option value="45">45</option>
                        <option value="46">46</option>
                        <option value="47">47</option>
                        <option value="48">48</option>
                        <option value="49">49</option>
                        <option value="50">50</option>
                        <option value="51">51</option>
                        <option value="52">52</option>
                        <option value="53">53</option>
                        <option value="54">54</option>
                        <option value="55">55</option>
                        <option value="56">56</option>
                        <option value="57">57</option>
                        <option value="58">58</option>
                        <option value="59">59</option>
                        <option value="60">60</option>
                        <option value="61">61</option>
                        <option value="62">62</option>
                        <option value="63">63</option>
                        <option value="64">64</option>
                        <option value="65">65</option>
                        <option value="66">66</option>
                        <option value="67">67</option>
                        <option value="68">68</option>
                        <option value="69">69</option>
                        <option value="70">70</option>
                        <option value="71">71</option>
                        <option value="72">72</option>
                        <option value="73">73</option>
                        <option value="74">74</option>
                        <option value="75">75</option>
                        <option value="76">76</option>
                        <option value="77">77</option>
                        <option value="78">78</option>
                        <option value="79">79</option>
                        <option value="80">80</option>
                        <option value="81">81</option>
                        <option value="82">82</option>
                        <option value="83">83</option>
                        <option value="84">84</option>
                        <option value="85">85</option>
                        <option value="86">86</option>
                        <option value="87">87</option>
                        <option value="88">88</option>
                        <option value="89">89</option>
                        <option value="90">90</option>
                        <option value="91">91</option>
                        <option value="92">92</option>
                        <option value="93">93</option>
                        <option value="94">94</option>
                        <option value="95">95</option>
                        <option value="96">96</option>
                        <option value="97">97</option>
                        <option value="98">98</option>
                        <option value="99">99</option>
                    </select>

                    <div>
                        <br><button>サーチ</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

    <a href="hometimeline.php">マイタイムライン</a>

    <script>
        ;
        (function(window, document) {
            "use strict";
            var pluginName = 'particleground';

            // http://youmightnotneedjquery.com/#deep_extend
            function extend(out) {
                out = out || {};
                for (var i = 1; i < arguments.length; i++) {
                    var obj = arguments[i];
                    if (!obj) continue;
                    for (var key in obj) {
                        if (obj.hasOwnProperty(key)) {
                            if (typeof obj[key] === 'object')
                                deepExtend(out[key], obj[key]);
                            else
                                out[key] = obj[key];
                        }
                    }
                }
                return out;
            };

            var $ = window.jQuery;

            function Plugin(element, options) {
                var canvasSupport = !!document.createElement('canvas').getContext;
                var canvas;
                var ctx;
                var particles = [];
                var raf;
                var mouseX = 0;
                var mouseY = 0;
                var winW;
                var winH;
                var desktop = !navigator.userAgent.match(/(iPhone|iPod|iPad|Android|BlackBerry|BB10|mobi|tablet|opera mini|nexus 7)/i);
                var orientationSupport = !!window.DeviceOrientationEvent;
                var tiltX = 0;
                var pointerX;
                var pointerY;
                var tiltY = 0;
                var paused = false;

                options = extend({}, window[pluginName].defaults, options);

                /**
                 * Init
                 */
                function init() {
                    if (!canvasSupport) {
                        return;
                    }

                    //Create canvas
                    canvas = document.createElement('canvas');
                    canvas.className = 'pg-canvas';
                    canvas.style.display = 'block';
                    element.insertBefore(canvas, element.firstChild);
                    ctx = canvas.getContext('2d');
                    styleCanvas();

                    // Create particles
                    var numParticles = Math.round((canvas.width * canvas.height) / options.density);
                    for (var i = 0; i < numParticles; i++) {
                        var p = new Particle();
                        p.setStackPos(i);
                        particles.push(p);
                    };

                    window.addEventListener('resize', function() {
                        resizeHandler();
                    }, false);

                    document.addEventListener('mousemove', function(e) {
                        mouseX = e.pageX;
                        mouseY = e.pageY;
                    }, false);

                    if (orientationSupport && !desktop) {
                        window.addEventListener('deviceorientation', function() {
                            // Contrain tilt range to [-30,30]
                            tiltY = Math.min(Math.max(-event.beta, -30), 30);
                            tiltX = Math.min(Math.max(-event.gamma, -30), 30);
                        }, true);
                    }

                    draw();
                    hook('onInit');
                }

                /**
                 * Style the canvas
                 */
                function styleCanvas() {
                    canvas.width = element.offsetWidth;
                    canvas.height = element.offsetHeight;
                    ctx.fillStyle = options.dotColor;
                    ctx.strokeStyle = options.lineColor;
                    ctx.lineWidth = options.lineWidth;
                }

                /**
                 * Draw particles
                 */
                function draw() {
                    if (!canvasSupport) {
                        return;
                    }

                    winW = window.innerWidth;
                    winH = window.innerHeight;

                    // Wipe canvas
                    ctx.clearRect(0, 0, canvas.width, canvas.height);

                    // Update particle positions
                    for (var i = 0; i < particles.length; i++) {
                        particles[i].updatePosition();
                    };
                    // Draw particles
                    for (var i = 0; i < particles.length; i++) {
                        particles[i].draw();
                    };

                    // Call this function next time screen is redrawn
                    if (!paused) {
                        raf = requestAnimationFrame(draw);
                    }
                }

                /**
                 * Add/remove particles.
                 */
                function resizeHandler() {
                    // Resize the canvas
                    styleCanvas();

                    var elWidth = element.offsetWidth;
                    var elHeight = element.offsetHeight;

                    // Remove particles that are outside the canvas
                    for (var i = particles.length - 1; i >= 0; i--) {
                        if (particles[i].position.x > elWidth || particles[i].position.y > elHeight) {
                            particles.splice(i, 1);
                        }
                    };

                    // Adjust particle density
                    var numParticles = Math.round((canvas.width * canvas.height) / options.density);
                    if (numParticles > particles.length) {
                        while (numParticles > particles.length) {
                            var p = new Particle();
                            particles.push(p);
                        }
                    } else if (numParticles < particles.length) {
                        particles.splice(numParticles);
                    }

                    // Re-index particles
                    for (i = particles.length - 1; i >= 0; i--) {
                        particles[i].setStackPos(i);
                    };
                }

                /**
                 * Pause particle system
                 */
                function pause() {
                    paused = true;
                }

                /**
                 * Start particle system
                 */
                function start() {
                    paused = false;
                    draw();
                }

                /**
                 * Particle
                 */
                function Particle() {
                    this.stackPos;
                    this.active = true;
                    this.layer = Math.ceil(Math.random() * 3);
                    this.parallaxOffsetX = 0;
                    this.parallaxOffsetY = 0;
                    // Initial particle position
                    this.position = {
                        x: Math.ceil(Math.random() * canvas.width),
                        y: Math.ceil(Math.random() * canvas.height)
                    }
                    // Random particle speed, within min and max values
                    this.speed = {}
                    switch (options.directionX) {
                        case 'left':
                            this.speed.x = +(-options.maxSpeedX + (Math.random() * options.maxSpeedX) - options.minSpeedX).toFixed(2);
                            break;
                        case 'right':
                            this.speed.x = +((Math.random() * options.maxSpeedX) + options.minSpeedX).toFixed(2);
                            break;
                        default:
                            this.speed.x = +((-options.maxSpeedX / 2) + (Math.random() * options.maxSpeedX)).toFixed(2);
                            this.speed.x += this.speed.x > 0 ? options.minSpeedX : -options.minSpeedX;
                            break;
                    }
                    switch (options.directionY) {
                        case 'up':
                            this.speed.y = +(-options.maxSpeedY + (Math.random() * options.maxSpeedY) - options.minSpeedY).toFixed(2);
                            break;
                        case 'down':
                            this.speed.y = +((Math.random() * options.maxSpeedY) + options.minSpeedY).toFixed(2);
                            break;
                        default:
                            this.speed.y = +((-options.maxSpeedY / 2) + (Math.random() * options.maxSpeedY)).toFixed(2);
                            this.speed.x += this.speed.y > 0 ? options.minSpeedY : -options.minSpeedY;
                            break;
                    }
                }

                /**
                 * Draw particle
                 */
                Particle.prototype.draw = function() {
                    // Draw circle
                    ctx.beginPath();
                    ctx.arc(this.position.x + this.parallaxOffsetX, this.position.y + this.parallaxOffsetY, options.particleRadius / 2, 0, Math.PI * 2, true);
                    ctx.closePath();
                    ctx.fill();

                    // Draw lines
                    ctx.beginPath();
                    // Iterate over all particles which are higher in the stack than this one
                    for (var i = particles.length - 1; i > this.stackPos; i--) {
                        var p2 = particles[i];

                        // Pythagorus theorum to get distance between two points
                        var a = this.position.x - p2.position.x
                        var b = this.position.y - p2.position.y
                        var dist = Math.sqrt((a * a) + (b * b)).toFixed(2);

                        // If the two particles are in proximity, join them
                        if (dist < options.proximity) {
                            ctx.moveTo(this.position.x + this.parallaxOffsetX, this.position.y + this.parallaxOffsetY);
                            if (options.curvedLines) {
                                ctx.quadraticCurveTo(Math.max(p2.position.x, p2.position.x), Math.min(p2.position.y, p2.position.y), p2.position.x + p2.parallaxOffsetX, p2.position.y + p2.parallaxOffsetY);
                            } else {
                                ctx.lineTo(p2.position.x + p2.parallaxOffsetX, p2.position.y + p2.parallaxOffsetY);
                            }
                        }
                    }
                    ctx.stroke();
                    ctx.closePath();
                }

                /**
                 * update particle position
                 */
                Particle.prototype.updatePosition = function() {
                    if (options.parallax) {
                        if (orientationSupport && !desktop) {
                            // Map tiltX range [-30,30] to range [0,winW]
                            var ratioX = (winW - 0) / (30 - -30);
                            pointerX = (tiltX - -30) * ratioX + 0;
                            // Map tiltY range [-30,30] to range [0,winH]
                            var ratioY = (winH - 0) / (30 - -30);
                            pointerY = (tiltY - -30) * ratioY + 0;
                        } else {
                            pointerX = mouseX;
                            pointerY = mouseY;
                        }
                        // Calculate parallax offsets
                        this.parallaxTargX = (pointerX - (winW / 2)) / (options.parallaxMultiplier * this.layer);
                        this.parallaxOffsetX += (this.parallaxTargX - this.parallaxOffsetX) / 10; // Easing equation
                        this.parallaxTargY = (pointerY - (winH / 2)) / (options.parallaxMultiplier * this.layer);
                        this.parallaxOffsetY += (this.parallaxTargY - this.parallaxOffsetY) / 10; // Easing equation
                    }

                    var elWidth = element.offsetWidth;
                    var elHeight = element.offsetHeight;

                    switch (options.directionX) {
                        case 'left':
                            if (this.position.x + this.speed.x + this.parallaxOffsetX < 0) {
                                this.position.x = elWidth - this.parallaxOffsetX;
                            }
                            break;
                        case 'right':
                            if (this.position.x + this.speed.x + this.parallaxOffsetX > elWidth) {
                                this.position.x = 0 - this.parallaxOffsetX;
                            }
                            break;
                        default:
                            // If particle has reached edge of canvas, reverse its direction
                            if (this.position.x + this.speed.x + this.parallaxOffsetX > elWidth || this.position.x + this.speed.x + this.parallaxOffsetX < 0) {
                                this.speed.x = -this.speed.x;
                            }
                            break;
                    }

                    switch (options.directionY) {
                        case 'up':
                            if (this.position.y + this.speed.y + this.parallaxOffsetY < 0) {
                                this.position.y = elHeight - this.parallaxOffsetY;
                            }
                            break;
                        case 'down':
                            if (this.position.y + this.speed.y + this.parallaxOffsetY > elHeight) {
                                this.position.y = 0 - this.parallaxOffsetY;
                            }
                            break;
                        default:
                            // If particle has reached edge of canvas, reverse its direction
                            if (this.position.y + this.speed.y + this.parallaxOffsetY > elHeight || this.position.y + this.speed.y + this.parallaxOffsetY < 0) {
                                this.speed.y = -this.speed.y;
                            }
                            break;
                    }

                    // Move particle
                    this.position.x += this.speed.x;
                    this.position.y += this.speed.y;
                }

                /**
                 * Setter: particle stacking position
                 */
                Particle.prototype.setStackPos = function(i) {
                    this.stackPos = i;
                }

                function option(key, val) {
                    if (val) {
                        options[key] = val;
                    } else {
                        return options[key];
                    }
                }

                function destroy() {
                    console.log('destroy');
                    canvas.parentNode.removeChild(canvas);
                    hook('onDestroy');
                    if ($) {
                        $(element).removeData('plugin_' + pluginName);
                    }
                }

                function hook(hookName) {
                    if (options[hookName] !== undefined) {
                        options[hookName].call(element);
                    }
                }

                init();

                return {
                    option: option,
                    destroy: destroy,
                    start: start,
                    pause: pause
                };
            }

            window[pluginName] = function(elem, options) {
                return new Plugin(elem, options);
            };

            window[pluginName].defaults = {
                minSpeedX: 0.1,
                maxSpeedX: 0.7,
                minSpeedY: 0.1,
                maxSpeedY: 0.7,
                directionX: 'center', // 'center', 'left' or 'right'. 'center' = dots bounce off edges
                directionY: 'center', // 'center', 'up' or 'down'. 'center' = dots bounce off edges
                density: 10000, // How many particles will be generated: one particle every n pixels
                dotColor: '#666666',
                lineColor: '#666666',
                particleRadius: 7, // Dot size
                lineWidth: 1,
                curvedLines: false,
                proximity: 100, // How close two dots need to be before they join
                parallax: true,
                parallaxMultiplier: 5, // The lower the number, the more extreme the parallax effect
                onInit: function() {},
                onDestroy: function() {}
            };

            // nothing wrong with hooking into jQuery if it's there...
            if ($) {
                $.fn[pluginName] = function(options) {
                    if (typeof arguments[0] === 'string') {
                        var methodName = arguments[0];
                        var args = Array.prototype.slice.call(arguments, 1);
                        var returnVal;
                        this.each(function() {
                            if ($.data(this, 'plugin_' + pluginName) && typeof $.data(this, 'plugin_' + pluginName)[methodName] === 'function') {
                                returnVal = $.data(this, 'plugin_' + pluginName)[methodName].apply(this, args);
                            }
                        });
                        if (returnVal !== undefined) {
                            return returnVal;
                        } else {
                            return this;
                        }
                    } else if (typeof options === "object" || !options) {
                        return this.each(function() {
                            if (!$.data(this, 'plugin_' + pluginName)) {
                                $.data(this, 'plugin_' + pluginName, new Plugin(this, options));
                            }
                        });
                    }
                };
            }

        })(window, document);

        /**
         * requestAnimationFrame polyfill by Erik Möller. fixes from Paul Irish and Tino Zijdel
         * @see: http://paulirish.com/2011/requestanimationframe-for-smart-animating/
         * @see: http://my.opera.com/emoller/blog/2011/12/20/requestanimationframe-for-smart-er-animating
         * @license: MIT license
         */
        (function() {
            var lastTime = 0;
            var vendors = ['ms', 'moz', 'webkit', 'o'];
            for (var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
                window.requestAnimationFrame = window[vendors[x] + 'RequestAnimationFrame'];
                window.cancelAnimationFrame = window[vendors[x] + 'CancelAnimationFrame'] ||
                    window[vendors[x] + 'CancelRequestAnimationFrame'];
            }

            if (!window.requestAnimationFrame)
                window.requestAnimationFrame = function(callback, element) {
                    var currTime = new Date().getTime();
                    var timeToCall = Math.max(0, 16 - (currTime - lastTime));
                    var id = window.setTimeout(function() {
                            callback(currTime + timeToCall);
                        },
                        timeToCall);
                    lastTime = currTime + timeToCall;
                    return id;
                };

            if (!window.cancelAnimationFrame)
                window.cancelAnimationFrame = function(id) {
                    clearTimeout(id);
                };
        }());

        document.addEventListener('DOMContentLoaded', function() {
            particleground(document.getElementById('particles'), {
                dotColor: '#eee',
                lineColor: '#eee'
            });
            var intro = document.getElementById('intro');
            intro.style.marginTop = -intro.offsetHeight / 2 + 'px';
        }, false);
    </script>
</body>

</html>
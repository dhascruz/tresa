<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Theme Tresa - version information.
 *
 * @package   theme_tresa
 * @copyright 2026 Tresa Theme
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

$plugin->component = 'theme_tresa';
// v2.0.7: fixed theme_tresa/scripts - tab clicks (e.g. Site administration's
// General/Users/Courses/Plugins tabs on admin/search.php) were correctly
// matching their in-page .tab-pane target and marking the clicked tab
// active, but the OLD pane never got deactivated, so the content never
// visibly changed. Cause: the code looked for the .tab-content wrapper next
// to the clicked tab link (navList.nextElementSibling), but on that page the
// tab links (rendered in the header) and the tab panes (rendered separately,
// deep inside main content) aren't DOM siblings at all. Fixed by locating
// sibling panes from the TARGET pane's own parent instead - the same
// approach Bootstrap's real tab.js uses - so it works regardless of where
// the tab links live relative to the panes.
// v2.0.8: fixed the calendar (dashboard block + full calendar page), which
// rendered with no visible date numbers. Root cause: core's calendar
// templates mark each day's number with "d-none d-md-block" (hide below the
// md breakpoint, show at/above it) for the desktop layout and "d-md-none"
// for the mobile layout - the standard Bootstrap responsive-swap pattern.
// Tresa's hand-rolled utilities defined the breakpoint-scoped .d-md-block
// rule (inside a min-width media query) BEFORE the plain .d-none rule, so
// at desktop widths, both rules matched with equal specificity and
// !important, and the later one in source order (.d-none) always won -
// permanently hiding the desktop day numbers while .d-md-none correctly hid
// the mobile copy, leaving nothing visible. Fixed by moving the plain
// .d-none/.d-block/etc. utilities before the responsive @each loop that
// generates .d-{bp}-none/.d-{bp}-block, so the breakpoint-scoped rule wins
// once its media query matches (same ordering Bootstrap itself uses). Also
// added theme_tresa/scss/tresa/_calendar.scss - real styling for the
// calendar table, day cells, today/event highlighting, prev/next controls
// and event list, none of which had any CSS before - plus the missing
// .hide/.hidden legacy Bootstrap utility classes core calendar templates
// rely on to hide the "|" caption separators and popover content until JS
// reveals them.
// v2.0.9: added theme_tresa/scss/tresa/_popover.scss (real .popover/.tooltip
// styling - used by the calendar's hover event popup AND every core help
// icon site-wide, none of which had any CSS before, so they rendered as
// invisible/unpositioned boxes) and theme_tresa/scss/tresa/_dialogue.scss
// (the legacy YUI "moodle-dialogue" popup chrome used by the file
// picker/file manager - Edit file, Create folder, delete confirmations,
// etc. Previously totally unstyled: no backdrop, no card/border/shadow, so
// it rendered as plain unpositioned content shoved into the page instead of
// a floating dialog - plus layout basics for the file picker/manager
// toolbar, thumbnail and file-properties form shown inside it).
// v2.0.10: fixed the login page. Two bugs: (1) the wrapper <div> around the
// login card and the <body> element both carried the class "tresa-login"
// (body via body_attributes(['tresa-login']), the div directly in
// login.mustache), so the bare ".tresa-login" CSS selector matched <body>
// too, making <body> "display:flex; align-items:center; justify-content:
// center" - which turned ALL of its direct children (the real login
// wrapper, the footer strip with "You are not logged in"/privacy/mobile-app
// links, and a couple of Moodle's own empty utility divs) into centred flex
// items sitting in a row, instead of the footer following normally
// underneath the card - that's why it floated disconnected to the right at
// card height. Fixed with ".tresa-login:not(body)" so only the div matches.
// (2) There was no left-hand image/branding panel at all, just empty
// background - added a proper two-pane layout (branding + hero image or
// gradient fallback on the left from the lg breakpoint up, login card on
// the right; falls back to a single centred card with inline branding
// below the lg breakpoint).
// v2.0.11: login panel was 45% width capped at 640px, not a true half/half
// split. Changed to flex: 0 0 50% / max-width: 50%, so the image panel and
// the login card each take exactly half the screen from the lg breakpoint
// up.
// v2.0.12: plugin directory review fixes. Added the Privacy API null provider,
// the GPL LICENSE file, Moodle boilerplate headers on every source file and
// thirdpartylibs.xml with the font licence texts. Removed the placeholder
// dashboard widgets (fixed demo statistics) and the unused layouts/ and style/
// copies. The front page course grid now uses core_course_category so category
// and course visibility rules apply, and the welcome button only links to
// local_dbajourney when that plugin is installed.
$plugin->version   = 2026112000;
$plugin->requires  = 2024100700; // Moodle 4.5+ (developed and verified against 5.2.1).
$plugin->maturity  = MATURITY_STABLE;
$plugin->release   = '2.0.12';

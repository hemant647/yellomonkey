## Design System: YelloMonkey Labs

### Pattern
- **Name:** Storytelling + Feature-Rich
- **CTA Placement:** Above fold
- **Sections:** Hero > Features > CTA

### Style
- **Name:** Motion-Driven
- **Keywords:** Animation-heavy, microinteractions, smooth transitions, scroll effects, parallax, entrance anim, page transitions
- **Best For:** Portfolio sites, storytelling platforms, interactive experiences, entertainment apps, creative, SaaS
- **Performance:** ⚠ Good | **Accessibility:** ⚠ Prefers-reduced-motion

### Colors
| Role | Hex |
|------|-----|
| Primary | #EC4899 |
| Secondary | #F472B6 |
| CTA | #06B6D4 |
| Background | #FDF2F8 |
| Text | #831843 |

*Notes: Bold brand colors + Creative freedom*

### Typography
- **Heading:** Bebas Neue
- **Body:** Source Sans 3
- **Mood:** bold, impactful, strong, dramatic, modern, headlines
- **Best For:** Marketing sites, portfolios, agencies, event pages, sports
- **Google Fonts:** https://fonts.google.com/share?selection.family=Bebas+Neue|Source+Sans+3:wght@300;400;500;600;700
- **CSS Import:**
```css
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Source+Sans+3:wght@300;400;500;600;700&display=swap');
```

### Key Effects
Scroll anim (Intersection Observer), hover (300-400ms), entrance, parallax (3-5 layers), page transitions

### Avoid (Anti-patterns)
- Boring design
- Hidden work

### Pre-Delivery Checklist
- [ ] No emojis as icons (use SVG: Heroicons/Lucide)
- [ ] cursor-pointer on all clickable elements
- [ ] Hover states with smooth transitions (150-300ms)
- [ ] Light mode: text contrast 4.5:1 minimum
- [ ] Focus states visible for keyboard nav
- [ ] prefers-reduced-motion respected
- [ ] Responsive: 375px, 768px, 1024px, 1440px


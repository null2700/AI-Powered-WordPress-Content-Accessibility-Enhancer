# AI-Powered Accessibility Enhancer
A WordPress plugin that improves your site's accessibility using AI. Scan any post/page HTML, and get actionable tips to improve compliance with WCAG standards.

## Features
- HTML scanner for missing alt text, ARIA labels, contrast issues
- AI-generated suggestions
- Score out of 100
- WordPress admin integration

## Setup
1. Copy to `wp-content/plugins/wp-accessibility-enhancer`
2. Install Python libs: `pip install flask openai flask-cors`
3. Run backend: `python api/ai-accessibility.py`
4. Activate plugin from WordPress admin

## License
MIT

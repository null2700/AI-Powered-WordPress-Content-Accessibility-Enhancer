from flask import Flask, request, jsonify
from flask_cors import CORS
import openai

app = Flask(__name__)
CORS(app)
openai.api_key = 'YOUR_API_KEY'

@app.route('/analyze-accessibility', methods=['POST'])
def analyze_accessibility():
    data = request.get_json()
    html = data['html']
    prompt = f"""
    Analyze the following HTML content for accessibility issues (e.g. missing alt text, bad contrast, no labels).
    Provide an accessibility score out of 100 and list of suggestions:
    {html}
    """

    response = openai.ChatCompletion.create(
        model="gpt-3.5-turbo",
        messages=[{"role": "user", "content": prompt}],
        max_tokens=500
    )

    return jsonify({"result": response['choices'][0]['message']['content']})

if __name__ == '__main__':
    app.run(debug=True)

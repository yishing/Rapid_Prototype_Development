import re
s1="The gooey peanut butter and jelly sandwich was a beauty."
print(re.findall(r'\b\w*[(aeiou)][aeiou][(aeiou)]\w*\b',s1))
re.findall(r'^[A-F][A-F]\d{3,4}$','AA312')
# re.match(r'^\w*[(aeiou)][aeiou][(aeiou)]\w*$',s1)
# r1=re.search(r'^\w*[(aeiou)][aeiou][(aeiou)]\w*$',s1)
# print(re.findall(r'\d{1,5}\s\w+\s\w\.','faewf324 kobe st.weafwef'))
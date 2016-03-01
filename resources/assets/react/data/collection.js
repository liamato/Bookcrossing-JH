var Collection = class Collection {

	constructor(items = []) {
		Object.defineProperty(this, 'length', {
			value: 0,
			enumerable: false,
			writable: true
		});
		this.massInsert(items);
	}

	static make(items = []) {
		return new Collection(items);
	}

	all(keyed = false) {
		let ret = [];
		if (keyed) {
			this.keys().map((key) => {ret[key] = this[key]});
		} else {
			this.keys().map((key) => {ret.push(this[key])});
		}
		return ret;
	}


	collapse() {
		let res = [];
		this.map((value) => {
			if (value instanceof Collection) {
				value = value.all(true);
			}
			res.concat(value);
		});
		return res;
	}

	contains(key, value) {
		if(this.has(key)){
			if (value !== undefined) {
				if (this[key] === value) {
					return true;
				}
				return false;
			}
			return true;
		}
		return false;
	}

	diff(items) {
		return this.filter((i) => {return items.indexOf(i) < 0});
	}

	each(callback, scoope) {
		this.all(true).forEach((value, index) => {
			this[index] = callback(value, index) || value;
		}, scoope || this);
		return this;
	}

	filter(callback) {
		if (typeof(callback) !== "function") {
			callback = (i) => i ? true : false;
		}
		let ret = this.all().filter((value, index) => {return callback(value, index)});
		return new Collection(ret);
	}

	where(key, value, strict = true) {
		return this.filter((item) => {
			return strict ? item[key] === value : item[key] == value;
		});
	}

	whereLoose(key, value) {
		return this.where(key, value, false);
	}

	first(callback = null, def = null) {
		if (callback === null) {
			return !this.isEmpty() ? this[this.keys()[0]] : null;
		}
		if (typeof(callback) === "function") {
			let key = this.keys()[0]
			let ret = callback(key, this[key])
			if (ret === undefined ? true : ret) {
				return this[key];
			}
		}
		return typeof(def) === "function" ? def() : def;
	}

	flip() {
		let trans = this.all(true);
		let ret = new Collection;
		let temp = [];
		for (key in trans) {
			if (!trans.hasOwnProperty(key)) {
				continue;
			}
			if (isNaN(trans[key])) {
				temp.push(key);
			} else {
				ret.put(trans[key], key);
			}
		}
		ret.massInsert(temp);
		return ret;
	}

	forget(key) {
		if (this.has(key)) {
			delete this[key];
		}
		return this;
	}

	clear() {
		this.keys().map((v, key) => {
			this.forget(key);
		});
	}

	get(key, def = null) {
		if (key instanceof Array) {
			let ret = new Collection;
			key.map((k)=>{
				ret.push(this.get(k));
			});
			return ret;
		} else if (this.has(key)) {
			return this[key];
		}
		return def;
	}

	groupBy(groupBy, preserveKeys = false) {
		if (typeof(groupBy) !== "function") {
			groupBy = (target) => {
				let key = groupBy;
				if (key === undefined) {
					return target;
				}
				if (target[key] !== undefined) {
					target = target[key];
				}
				return target;
			}
		}

		let results = {};

		this.keys().map((key, value) => {
			let groupKey = groupBy(this[value], value);

			if (Object.keys(results).indexOf(groupKey) === -1) {
				results[groupKey] =  new Collection;
			}
			if (preserveKeys) {
				results[groupKey].push(value, this[value])
			} else {
				results[groupKey].push(this[value])
			}

		});

		return results;
	}

	keyBy(keyBy) {
		if (typeof(keyBy) !== "function") {
			keyBy = (target) => {
				let key = keyBy;
				if (key === undefined) {
					return target;
				}
				if (target[key] !== undefined) {
					target = target[key];
				}
				return target;
			}
		}

		let results = {};

		this.keys().map((key, value) => {
			results[keyBy(this[value])] = this[value];
		});

		return results;
	}

	has(key) {
		return this.keys().indexOf(key.toString()) > -1;
	}

	implode(value, glue = undefined) {
		if (this.first() instanceof Array || typeof(this.first()) === "object") {
			return this.pluck(value).all(true).join(glue);
		}
		return this.all(true).join(value);
	}

	intersect(items) {
		return this.filter((i) => {
		    return items.indexOf(i) != -1
		});
	}

	isEmpty() {
		return this.length < 1;
	}

	keys(collection = false) {
		return collection ? new Collection(Object.keys(this)) : Object.keys(this);
	}

	lastKey(def = null) {
		let key = this.keys()[this.keys().length - 1];
		return key === undefined || key < 0 ? def : parseInt(key, 10);
	}

	last(callback = null) {
		let val = this[this.lastKey()];
		if (typeof(callback) === "function") {
			return callback(val);
		}
		return val;
	}

	nextKey() {
		let last = this.lastKey();
		return last === null ? 0 : last + 1;
	}

	pluck(value, key = null) {
		let results = new Collection;

		this.all(true).map((i, item) => {
			let itemValue = item[value];
			if (key === null) {
				results.push(itemValue);
			} else {
				results.put(key, itemValue);
			}
		});

		return results;
	}

	lists(value, key = null) {
		return this.pluck(value, key);
	}

	map(callback, collection = false) {
		//return collection ? new Collection(this.all(true)).each(callback) : new Collection(this.all(true)).each(callback).all(true);
		let ret = [];
		this.keys().map((index) => {
			ret.push(callback(this[index], index) || this[index]);
		}, this);
		return collection ? new Collection(ret) : ret;
	}

	max(key) {
		return this.reduce((result, item) => {
			let value = key === undefined ? item : item[key];
			return result === null || value > result ? value : result;
		});
	}

	merge(items) {
		return new Collection(this.all(true).concat(items));
	}

	min(key) {
		return this.reduce((result, item) => {
			let value = key === undefined ? item : item[key];
			return result === null || value < result ? value : result;
		});
	}

	forPage(page, perPage) {
		page = perPage === undefined ? page - 1 : (page - 1) * perPage;
		return this.slice(page, perPage);
	}

	pop() {
		return this.pull(this.lastKey());
	}

	prepend(value) {
		return new Collection(value).massInsert(this.all(true));
	}

	massInsert(items = []) {
		if (items instanceof Array) {
			items.map((value) => {
				this.push(value);
			});
		} else if (items instanceof Object) {
			Object.keys(items).map((value, index) => {
				this.put(value, items[value]);
			});
		} else {
			this.push(items);
		}
		return this;
	}

	push(value) {
		this.put(value);
	}

	pull(key, def = null) {
		let ret = this.get(key, def);
		this.forget(key);
		return ret;
	}

	put(index, value) {
		if (index !== undefined) {
			if (value === undefined) {
				value = index;
				index = this.nextKey();
			}
			if (isNaN(index)) { index = this.nextKey() }
			if (!this.has(index)) {
				this.length++;
				var has = this.keys();
			}
			this[index] = value;
			return this;
		}
	}

	random(amount = 1) {
		if (!amount > this.length) {
			let keys = new Collection;
			for (let x = 0; x > amount; x++) {
				keys.push(this.keys()[Math.floor(Math.random()*this.keys().length)])
			}
			if (amount == 1) {
				return keys.first();
			}
			return keys;
		}
	}

	reduce(callback, inital = null) {
		return this.all(true).reduce(callback, inital);
	}

	reject(callback) {
		if (typeof(callback) === "function") {
			return this.filter((item) => {
				return ! callback(item);
			});
		}

		return this.filter((item) => {
			return item != callback;
		});
	}

	reverse() {
		return new Collection(this.all(true).reverse());
	}

	search(value, step, strict = false) {
		let ret = [];
		if (typeof(value) !== "function") {
			this.keys().map((key) => {
				if (!strict) {
					if (step){
						//console.log(this[key][step]);
						if (this[key][step] == value) {
							ret.push(key);
						}
					} else {
						if (this[key] == value) {
							ret.push(key);
						}
					}
				} else {
					if (step){
						if (this[key][step] === value) {
							ret.push(key);
						}
					} else {
						if (this[key] === value) {
							ret.push(key);
						}
					}
				}
			});
			return ret;
		}

		this.keys().map((key) => {
			if (value(this[key], key)) {
				ret.push(key);
			}
		});

		return ret;
	}

	fragSearch(value, step, strict = false) {
		let ret = [];
		this.keys().map((key) => {
			if (!strict) {
				if (step){
					if (this[key][step].toLowerCase().indexOf(value.toLowerCase())> -1) {
						ret.push(key);
					}
				} else {
					if (this[key].toLowerCase().indexOf(value.toLowerCase())>-1) {
						ret.push(key);
					}
				}
			} else {
				if (step){
					if (this[key][step].indexOf(value)>-1) {
						ret.push(key);
					}
				} else {
					if (this[key].indexOf(value)>-1) {
						ret.push(key);
					}
				}
			}
		});
		return ret;
	}

	shift() {
		return this.pull(this.keys()[0]);
	}

	shuffle() {
		let cp = this;
		this.clear();
		while (cp.length) {
			this.push(cp.pull(cp.random()));
		}
	}

	slice(offset, length) {
		let end = length !== undefined ? offset + length : undefined;
		return new Collection(this.all(true).slice(offset, end));
	}

	chunk(size, preserveKeys = false) {
		let ret = new Collection;
		let k = this.keys();
		while (k.length > 0) {
			let chunk = new Collection;
		    k.splice(0, size).map((value, index) => {
		    	if (preserveKeys) {
		    		index = value;
		    	}
		    	chunk.push(index, this[value]);
		    });
		    ret.push(chunk);
		}
		return ret;
	}

	sort(callback = null, key) {
		if (callback == null) {
			callback = (a,b) => {
				if (a > b) {
					return 1;
				}
				if (a < b) {
					return -1;
				}
				return 0;
			};
		}
		return new Collection(this.all().sort(callback));

	}

	sortBy(callback, descending = false) {
		if (typeof(callback) !== 'function') {
			if (typeof(callback) === undefined) {
				callback = null;
			}
			if (typeof(callback) === 'string') {
				var key = callback;
				callback = (a,b) => {
					a = a[key];
					b = b[key];

					if (a > b) {
						return 1;
					}
					if (a < b) {
						return -1;
					}
					return 0;
				};
			}
		}
		return descending ? this.sort(callback, key).reverse() : this.sort(callback, key);

	}

	sortByDesc(callback) {
		return this.sortBy(callback, true);
	}

	sortByNumeric(callback, descending = false) {
		if(typeof(callback) !== 'function' && typeof(callback) !== undefined) {
			let key = callback;
			callback = (a,b) => a[key] - b[key];
		}
		return this.sortBy(callback, descending);
	}

	splice(offset, length = 0, replacement = []) {
		if (replacement instanceof Array) {
			if (replacement.length) {
				replacement = [replacement];
			}
		} else {
			replacement = [replacement];
		}
		let all = this.all(true);
		replacement.unshift(offset, length);
		return new Collection(all.splice.apply(all, replacement))
	}

	sum(callback) {
		if (typeof(callback) !== 'function') {
			callback = (a) => a;
		}
		return this.reduce((r, i) => {
			return r === null ? r : r + callback(i);
		});
	}

	take(limit) {
		if (limit < 0) {
			return this.slice(limit, Math.abs(limit))
		}
		return this.slice(0, limit);
	}

	transform(callback) {
		this.clear();
		cp = this;
		cp.map((v,k) => {
			this.push(callback(v,k));
		})
		return this;
	}

	unique(key) {
		var exists = [];
		this.reject((i) => {
			if (typeof(key) === 'function') {
				i = key(i)
			}
			if (exists.indexOf(i) > -1) {
				return true
			}
			exists.push(i);
			return false;
		});
		return exists;
	}

	values(collection) {
		var ret = collection ? new Collection : [];
		this.map((v) => {
			ret.push(v);
		})
		return ret;
	}

	toJson(object = false) {
		return object ? JSON.stringfy(this) : JSON.stringfy(this.all(true));
	}
}

export default Collection;

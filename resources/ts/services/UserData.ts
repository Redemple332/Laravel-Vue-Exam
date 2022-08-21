import http from "../http-common";
class UserData {
  async getAll() {
    return http.get("/users");
  }
  async get(id: string) {
    return http.get(`/user/edit/${id}`);
  }
  async create(data: any) {
    return http.post("/user/store", data);
  }
  async update(id: string | number, data: any) {
    return http.put(`/user/${id}`, data);
  }
  async delete(id:  string | number) {
    return http.delete(`/user/${id}`);
  }
}
export default new UserData();